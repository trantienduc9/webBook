<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail; // Đường dẫn tới lớp mô hình email
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\View;
use App\Events\UserOnline;
use App\Events\ChatPrivate;
use Laravel\Ui\Presets\React;

class BooksController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
        $list_category = $this->bookService->getAllCategory();
        view()->share('list_category', $list_category);
    }

    public function index(Request $req)
    {

        // if ($req->id) {
        //     $list_books = $this->bookService->getBookCategory($req->id);
        // } else {
        //     $list_books = $this->bookService->getAllBook();
        // }

        if ($req->id) {
            $books = $this->bookService->getBookCategory($req->id);
        } else {
            $books = $this->bookService->getAllBook();
        }

        // Số lượng cuốn sách trên mỗi trang
        $perPage = 12;

        // Lấy trang hiện tại từ query string hoặc mặc định là 1
        $currentPage = Paginator::resolveCurrentPage();

        // Tạo một LengthAwarePaginator từ collection và thông tin về trang hiện tại, số lượng sách trên mỗi trang và URL cơ sở
        $list_books = new LengthAwarePaginator(
            $books->forPage($currentPage, $perPage),
            $books->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
        $page = request()->input('page');
        return view("index", compact('list_books', 'page'));
    }

    public function store(Request $req)
    {
        $books = $this->bookService->getBookById($req->id);
        return view("store", compact('books'));
    }

    public function create(Request $req)
    {
        $data = [
            "TenSach" => $req->productName,
            "TacGia" => $req->author,
            "Gia" => $req->price,
            "SoLuongTrongKho" => $req->quantity,
            "MoTa" => $req->description,
            "id_category" => $req->category,
        ];

        if (!$req->id_book) {
            $url = $this->processImage($req);
            $data["URL"] = $url;
            $books = $this->bookService->createBook($data);
        } else {
            $url = $this->processImage($req);
            if ($url) {
                $data["URL"] = $url;
            }
            $books = $this->bookService->updateBook($req->id_book, $data);
        }

        return redirect()->route("index");
    }

    private function processImage($req)
    {
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $fileName);
            return '/upload/' . $fileName;
        }
        return null;
    }

    public function delete(Request $req)
    {
        $this->bookService->deleteBook($req->id);
        return back();
    }

    public function edit(Request $req)
    {
        $books = $this->bookService->getBookById($req->id);
        return view("edit", compact('books'));
    }

    public function update(Request $req)
    {
        $data = [
            "TenSach" => $req->productName,
            "TacGia" => $req->author,
            "Gia" => $req->price,
            "SoLuongTrongKho" => $req->quantity,
            "MoTa" => $req->description,
        ];
        if ($req->hasFile('image')) {
            // Lấy file từ request
            $file = $req->file('image');

            // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Di chuyển file vào thư mục public/upload
            $file->move(public_path('upload'), $fileName);

            // Tạo đường dẫn tương đối của file đã lưu
            $url = '/upload/' . $fileName;
            $data['URL'] = $url;
        }

        $books = $this->bookService->updateBook($req->id, $data);
        return redirect()->route("index");
    }

    public function detail(Request $req)
    {

        $book = $this->bookService->getBookById($req->id);
        $comment = Comment::all();
        $check_like = "";
        $evalueat = $this->bookService->getfindByEvaluate($req->id);
        $count = count($evalueat);
        if ($evalueat) {
            $average = $evalueat->avg('level');
            $roundedAverage = intval(round($average, 0));
        } else {
            $roundedAverage = 0;
        }
        if (Auth::check()) {
            $check_like = $this->bookService->getLikeCheck(Auth::user()->id, $req->id);
        }
        return view("detail", compact("book", "comment", "check_like", "roundedAverage", "count"));
    }

    public function addtocart(Request $req)
    {
        // Lấy ID của sản phẩm được gửi từ client side
        $productId = $req->input('productId');
        // Giả sử bạn lưu thông tin giỏ hàng trong session, bạn có thể thực hiện các bước sau:

        // Kiểm tra xem session giỏ hàng đã được tạo chưa
        if (!$req->session()->has('cart')) {
            // Nếu chưa, tạo một giỏ hàng mới
            $req->session()->put('cart', []);
        }

        // Lấy thông tin giỏ hàng từ session
        $cart = $req->session()->get('cart');

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            $cart[$productId]['quantity'] += 1;
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng với số lượng là 1
            $cart[$productId] = [
                'quantity' => 1,
                // Thêm thông tin khác của sản phẩm vào đây nếu cần
            ];
        }

        // Lưu lại thông tin giỏ hàng vào session
        $req->session()->put('cart', $cart);

        // Tính toán số lượng sản phẩm trong giỏ hàng
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Trả về kết quả là số lượng sản phẩm trong giỏ hàng dưới dạng JSON
        return response()->json(['cartCount' => $cartCount]);
    }

    public function displaytocar(Request $req)
    {
        // Lấy thông tin giỏ hàng từ session
        $cart = $req->session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        // Trả về thông tin giỏ hàng dưới dạng JSON
        return response()->json(['cartCount' => $cartCount]);
    }

    public function login(Post $post)
    {
        // $userId = Auth::id();
        // dd($userId);
        // $this->authorize('view', $post);
        return view("login");
    }

    public function check_login(Request $req)
    {
        // Xác thực thông tin đăng nhập
        if (Auth::attempt(['email' => $req->username, 'password' => $req->password])) {
            // Đăng nhập thành công, lưu thông tin người dùng vào session
            // $req->session()->regenerate();
            $user = Auth::user();
            if ($user->trang_thai == 0) {
                return redirect()->back()->with(["error" => "Tài khoản của bạn chưa được cấp phép hoạt động"]);
            }

            // Thực hiện chuyển hướng sau khi đăng nhập thành công
            return redirect()->route('index');
        } else {
            return redirect()->back()->with(["error" => "Mật khẩu không đúng"]);
        }
    }

    public function cart()
    {

        $cart = session()->get('cart');
        $books = "";
        $bookQuantities = "";
        if ($cart && is_array($cart)) {
            $bookIds = array_keys($cart);
            $books = DB::table('books')->whereIn("id", $bookIds)->get();
            $bookQuantities = [];
            foreach ($cart as $key => $val) {
                $bookQuantities[$key] = $val;
            }
            return view("cart", compact('books', 'bookQuantities'));
        } else {
            // Xử lý trường hợp không có dữ liệu trong session cart
            // Ví dụ: hiển thị thông báo rằng giỏ hàng trống
            return view("cart", compact('books', 'bookQuantities'));
        }
    }

    public function changetocart(Request $req)
    {
        // Lấy ID của sản phẩm được gửi từ client side
        $productId = $req->input('productId');
        // Giả sử bạn lưu thông tin giỏ hàng trong session, bạn có thể thực hiện các bước sau:

        // Kiểm tra xem session giỏ hàng đã được tạo chưa
        if (!$req->session()->has('cart')) {
            // Nếu chưa, tạo một giỏ hàng mới
            $req->session()->put('cart', []);
        }

        // Lấy thông tin giỏ hàng từ session
        $cart = $req->session()->get('cart');

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            if ($req->sum == "zero") {
                if ($req->check == 1) {
                    $cart[$productId]['quantity'] -= 1;
                } else {
                    $cart[$productId]['quantity'] += 1;
                }
            } else {
                $cart[$productId]['quantity'] = $req->sum;
            }
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng với số lượng là 1
            $cart[$productId] = [
                'quantity' => 1,
                // Thêm thông tin khác của sản phẩm vào đây nếu cần
            ];
        }

        // Lưu lại thông tin giỏ hàng vào session
        $req->session()->put('cart', $cart);

        // Tính toán số lượng sản phẩm trong giỏ hàng
        $cartCount = array_sum(array_column($cart, 'quantity'));

        if ($req->check_all == 0) {
            // Trả về kết quả là số lượng sản phẩm trong giỏ hàng dưới dạng JSON
            return response()->json(['cartCount' => $cart[$productId]['quantity']]);
        } else {
            return response()->json(['cartCount' => $cartCount]);
        }
    }

    public function check_oder(Request $req)
    {
        $cart = session()->get('cart');
        $books = "";
        $bookQuantities = "";
        if ($cart && is_array($cart)) {
            $bookIds = array_keys($cart);
            $books = DB::table('books')->whereIn("id", $bookIds)->get();
            $bookQuantities = [];
            foreach ($cart as $key => $val) {
                $bookQuantities[$key] = $val;
            }
            return response()->json(['books' => $books, 'cartCount' => $bookQuantities]);
            // return view("cart", compact('books','bookQuantities'));
        } else {
            // Xử lý trường hợp không có dữ liệu trong session cart
            // Ví dụ: hiển thị thông báo rằng giỏ hàng trống
            return response()->json(['books' => $books, 'cartCount' => $bookQuantities]);
        }
    }
    public function order(Request $req)
    {
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $data_kh = [
            "Ten" => $req->fullname,
            "DiaChi" => $req->address,
            "Email" => $req->email,
            "SoDienThoai" => $req->phone,
            "ghi_chu" => $req->notes,
            "created_at" => $currentTime,
            "updated_at" => null,
        ];
        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
        }else{
            $user_id = null;
        }
        // Save Customer
        $customer_id = $this->bookService->createCustomer($data_kh);
        $data = json_decode($req->book);
        $cartCountArray = json_decode(json_encode($data->cartCount), true);
        foreach ($data->books as $book) {
            $price = $book->Gia * $cartCountArray[$book->id]['quantity'];
            $data_order = [
                "ID_Sach"  => $book->id,
                "ID_Kh"  => $customer_id->id,
                "id_user"  => $user_id,
                "SoLuong"  => $cartCountArray[$book->id]['quantity'],
                "Gia"  => $price,
                "trang_thai"  => 'danggiao',
                "created_at" => $currentTime,
                "updated_at" => null,
            ];
            $save_order = $this->bookService->createOder($data_order);
        }
        $req->session()->forget('cart');
        return redirect()->route("index");;
    }


    public function test()
    {
        // $idsend = Auth::user()->id;
        // // dd($idsend);
        // $id = 1;
        // $test = $this->bookService->getChatPrivateById($idsend,$id);
        // dd($test);
        // $data = [
        //     "level" => 2
        // ];
        // $updateaval = $this->bookService->updateEvaluateCheck(1,27,$data);
        // return "thành công";
        // $mail = "vu792009@gmail.com";

        // $check = Mail::to($mail)->send(new ConfirmationEmail($mail));
        // dd($check);
        // return "hihi";
        $user = Auth::user();
        $hasEditorRole = $user->roles->contains('name', 'Editor');
        $list_books = $this->bookService->getAllBook();
        return view("test", compact('list_books', 'hasEditorRole'));
    }

    public function list_order()
    {
        $order = Order::all();
        $khachhang = $this->bookService->getAllCustomer();
        return view("list_order", compact('order'));
    }

    public function comment(Request $req)
    {
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $data = [
            "id_book" => $req->id_book,
            "id_user" => $req->id_user,
            "comment" => $req->comment,
            "created_at" => $currentTime,
        ];
        $user = $this->bookService->getUserById($req->id_user);
        $comment = $this->bookService->createComment($data);

        return response()->json(['comment' => $comment, 'user' => $user]);
    }
    public function deletecomment(Request $req)
    {
        $comment = $this->bookService->deletComment($req->id);
        return $req->id;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginreal');
    }
    public function signup(Request $req)
    {
        // check = 1 là update lại mật khẩu, còn check = 2 là quyền admin
        $check = $req->check;
        $id_user = null;
        if (isset($req->id)) {
            $id_user = $req->id;
        }
        $inforuser = $this->bookService->getUserById($req->id);
        $RoleUser = RoleUser::where('user_id', $req->id)->first();
        // dd($check);
        return view("signup", compact('check', 'id_user', 'inforuser', 'RoleUser'));
    }

    // public function check_signup(Request $req)
    // {
    //     if ($req->check_tt) {
    //         $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    //         $createUser = [
    //             // "name" => $req->name,
    //             "updated_at" => $currentTime,
    //         ];
    //         if ($req->hasFile('image')) {
    //             // Lấy file từ request
    //             $file = $req->file('image');

    //             // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
    //             $fileName = time() . '_' . $file->getClientOriginalName();

    //             // Di chuyển file vào thư mục public/upload
    //             $file->move(public_path('upload'), $fileName);

    //             // Tạo đường dẫn tương đối của file đã lưu
    //             $url = '/upload/' . $fileName;

    //             $createUser["URL"] = $url;
    //         }

    //         if($req->check_tt == 1){
    //             $createUser["password"] = bcrypt($req->password);
    //         }


    //         $user = $this->bookService->updateUser($req->id_user, $createUser);
    //         $RoleUser = RoleUser::where('user_id', $req->id_user)->first();
    //             if($req->check_tt == 2){
    //                 $createRole = [
    //                     "role_id"   => $req->permission,
    //                 ];
    //                 $save_role = $this->bookService->updateRoleUser($RoleUser->id, $createRole);
    //             }
    //         session()->flash('success', 'Cập nhật thành công!');
    //     } else {

    //         $email = $req->email;
    //         // Kiểm tra xem email có tồn tại trong bảng User hay không
    //         $user = User::where('email', $email)->first();
    //         if ($user) {
    //             session()->flash('error', 'Tài khoản Email này đã tồn tại trên hệ thống!');
    //         } else {
    //             $pass = bcrypt($req->password);
    //             $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');

    //             if ($req->hasFile('image')) {
    //                 // Lấy file từ request
    //                 $file = $req->file('image');

    //                 // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
    //                 $fileName = time() . '_' . $file->getClientOriginalName();

    //                 // Di chuyển file vào thư mục public/upload
    //                 $file->move(public_path('upload'), $fileName);

    //                 // Tạo đường dẫn tương đối của file đã lưu
    //                 $url = '/upload/' . $fileName;
    //             } else {
    //                 // Nếu không có file, đặt đường dẫn là null hoặc giá trị mặc định
    //                 $url = null; // hoặc $url = 'default.jpg';

    //             }
    //             $createUser = [
    //                 "name" => $req->name,
    //                 "email" => $req->email,
    //                 "password" => $pass,
    //                 "created_at" => $currentTime,
    //                 "URL" => $url,
    //                 "trang_thai" => $req->trangthai,
    //             ];
    //             $user = $this->bookService->createUser($createUser);

    //             $createRole = [
    //                 "role_id"   => $req->permission,
    //                 "user_id"   => $user->id,
    //             ];
    //             $save_role = $this->bookService->createRoleUser($createRole);
    //             if ($req->trangthai == 0) {
    //                 session()->flash('success', 'Chúng tôi đã nhận được thông tin đăng ký tài khoản của bạn, bạn hãy kiểm tra mail khi chúng tôi đã  xác nhận!');
    //             } else {
    //                 session()->flash('success', 'Thành công');
    //             }
    //         }
    //     }

    //     return Redirect("login");
    // }


    public function check_signup(Request $req)
    {
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');

        if ($req->check_tt) {
            $createUser = [
                "updated_at" => $currentTime,
            ];

            if ($req->hasFile('image')) {
                $fileName = time() . '_' . $req->file('image')->getClientOriginalName();
                $req->file('image')->move(public_path('upload'), $fileName);
                $createUser["URL"] = '/upload/' . $fileName;
            }

            if ($req->check_tt == 1) {
                $createUser["password"] = bcrypt($req->password);
            }

            $this->bookService->updateUser($req->id_user, $createUser);

            if ($req->check_tt == 2) {
                $this->bookService->updateRoleUser($req->id_user, ["role_id" => $req->permission]);
            }

            session()->flash('success', 'Cập nhật thành công!');
        } else {
            $user = User::where('email', $req->email)->first();

            if ($user) {
                session()->flash('error', 'Tài khoản Email này đã tồn tại trên hệ thống!');
            } else {
                $pass = bcrypt($req->password);
                $url = null;

                if ($req->hasFile('image')) {
                    $fileName = time() . '_' . $req->file('image')->getClientOriginalName();
                    $req->file('image')->move(public_path('upload'), $fileName);
                    $url = '/upload/' . $fileName;
                }

                $createUser = [
                    "name" => $req->name,
                    "email" => $req->email,
                    "password" => $pass,
                    "created_at" => $currentTime,
                    "URL" => $url,
                    "trang_thai" => $req->trangthai,
                ];

                $user = $this->bookService->createUser($createUser);

                $this->bookService->createRoleUser(["role_id" => $req->permission, "user_id" => $user->id]);

                if ($req->trangthai == 0) {
                    session()->flash('success', 'Chúng tôi đã nhận được thông tin đăng ký tài khoản của bạn, bạn hãy kiểm tra mail khi chúng tôi đã  xác nhận!');
                } else {
                    session()->flash('success', 'Thành công');
                }
            }
        }

        return Redirect("login");
    }

    public function create_acc()
    {

        return view("signup");
    }

    public function list_acc()
    {
        $list_acc = $this->bookService->getAllUser();
        return view("list_acc", compact("list_acc"));
    }
    // public function edit_acc(Request $req)
    // {
    //     $edit_user = $this->bookService->getUserById($req->id);
    //     $RoleUser = RoleUser::where('user_id', $req->id)->first();
    //     return view("edit_acc", compact("edit_user", "RoleUser"));
    // }

    // public function update_acc(Request $req)
    // {
    //     $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
    //     $createUser = [
    //         "name" => $req->name,
    //         "updated_at" => $currentTime,
    //     ];
    //     if ($req->hasFile('image')) {
    //         // Lấy file từ request
    //         $file = $req->file('image');

    //         // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
    //         $fileName = time() . '_' . $file->getClientOriginalName();

    //         // Di chuyển file vào thư mục public/upload
    //         $file->move(public_path('upload'), $fileName);

    //         // Tạo đường dẫn tương đối của file đã lưu
    //         $url = '/upload/' . $fileName;

    //         $createUser["URL"] = $url;
    //     }

    //     $user = $this->bookService->updateUser($req->id_user, $createUser);

    //     if ($req->permission == 1) {
    //         $createRole = [
    //             "role_id"   => $req->permission,
    //         ];
    //         $save_role = $this->bookService->updateRoleUser($req->role_user, $createRole);
    //     }
    //     session()->flash('success', 'Cập nhật thành công!');

    //     return Redirect("list_acc");
    // }

    public function infor()
    {
        $id = Auth::user()->id;
        $user = $this->bookService->getUserById($id);
        return $user;
    }

    public function check_like(Request $req)
    {
        if ($req->check == 0) {
            $data = [
                "id_user" => Auth::user()->id,
                "id_book" => $req->idbook,
            ];
            $like = $this->bookService->createLike($data);
            return response()->json(['check' => 1, 'idbook' => $req->idbook]);
        } else {
            $like = $this->bookService->deletLikewhere(Auth::user()->id, $req->idbook);
            return response()->json(['check' => 0, 'idbook' => $req->idbook]);
        }
    }

    public function liked()
    {
        $likedBooks = [];
        $liked = $this->bookService->getLike(Auth::user()->id);

        foreach ($liked as $val) {
            $book = $this->bookService->getBookById($val->id_book);
            if ($book) {
                $likedBooks[] = $book;
            }
        }
        return view("liked", compact("likedBooks"));
    }

    public function acc_comfirm()
    {
        $comfirm = $this->bookService->getUserComfirm();
        return view("acc_comfirm", compact('comfirm'));
    }

    public function comfirm_acc(Request $req)
    {
        if ($req->check_comfirm == 1) {
            $data = [
                "trang_thai" => $req->check_comfirm,
            ];
            $allow = $this->bookService->updateUser($req->id, $data);
            Mail::to($req->email)->send(new ConfirmationEmail($req->email, $req->check_comfirm));
            return 1;
        } else {
            $data = [
                "trang_thai" => $req->check_comfirm,
            ];
            $allow = $this->bookService->updateUser($req->id, $data);
            Mail::to($req->email)->send(new ConfirmationEmail($req->email, $req->check_comfirm));
            return 2;
        }
    }

    public function evalueat(Request $req)
    {
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $id_user = Auth::user()->id;
        $check = $this->bookService->getEvaluateCheck($id_user, $req->id_book);
        if ($check) {
            $data = [
                "level" => $req->valevalueat
            ];
            $updateaval = $this->bookService->updateEvaluateCheck($id_user, $req->id_book, $data);
            $evalueat = $this->bookService->getfindByEvaluate($req->id_book);
            $count = count($evalueat);
            if ($evalueat) {
                $average = $evalueat->avg('level');
                $roundedAverage = intval(round($average, 0));
            } else {
                $roundedAverage = 0;
            }
        } else {
            $data = [
                "id_user" => $id_user,
                "id_book" => $req->id_book,
                "level" => $req->valevalueat,
                "created_at" => $currentTime,
            ];
            $updateaval = $this->bookService->createEvaluate($data);

            $evalueat = $this->bookService->getfindByEvaluate($req->id_book);
            $count = count($evalueat);
            if ($evalueat) {
                $average = $evalueat->avg('level');
                $roundedAverage = intval(round($average, 0));
            } else {
                $roundedAverage = 0;
            }
        }
        return response()->json(['roundedAverage' => $roundedAverage, 'count' => $count]);
    }

    public function check_pass(Request $req)
    {
        // Lấy mật khẩu đã mã hóa của người dùng hiện tại
        $hashedPassword = Auth::user()->password;

        // Lấy mật khẩu cũ được gửi từ form
        $oldPassword = $req->password_old;

        // Kiểm tra xem mật khẩu cũ có trùng khớp với mật khẩu đã lưu không
        if (Hash::check($oldPassword, $hashedPassword)) {
            // Mật khẩu cũ trùng khớp
            return 1;
        } else {
            // Mật khẩu cũ không trùng khớp
            return 0;
        }
    }

    public function product_sold(){
        $list_bought = $this->bookService->boughtOder(Auth::user()->id);
        return View("product_sold",compact("list_bought"));
    }

    public function chat(){
        $list_user = $this->bookService->getAllUserWhere(Auth::user()->id);
        return view("chat.chatpublic",compact("list_user"));
    }

    public function postMessage(Request $req){
        broadcast(new UserOnline($req->user(),$req->message));
        // return json_encode([
        //     'data'  => $req->message
        // ]);
    }

    public function chatPrivate($userId){
        $user = $this->bookService->getUserById($userId);
        $idsend = Auth::user()->id;
        $message = $this->bookService->getChatPrivateById($idsend,$userId);
        return view("chat.chatprivate",compact("user","message"));
    }

    public function messagePrivate($userId, Request $req){
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $idsend = Auth::user()->id;
        $userIdpr = $this->bookService->getUserById($userId);
        broadcast(new ChatPrivate($req->user(),$userIdpr,$req->message));
        $message = $this->bookService->getChatPrivateById($idsend,$userId);
        if(!$message){
            $data = [
                "id_send" => $idsend,
                "id_sent" => $userId,
            ];
            $message = $this->bookService->createChatPrivate($data);
        }
        $datapr = [
            "private_chat_id" => $message->id,
            "sender_id" => $idsend,
            "message" => $req->message,
            "created_at" => $currentTime,
        ];
        $messageprivate = $this->bookService->createMessagePrivate($datapr);

        return response()->json($req->message);
    }
}
