@extends('admin.default')

@section('title')
    Chi tiết sản phẩm
    @parent
@stop

@section('header_styles')
    <style>
        .comment-form {
            margin-bottom: 20px;
        }

        .comment-section {
            margin-top: 20px;
        }

        .comment {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .comment-section {
            margin-top: 20px;
        }

        .section-title {
            font-size: 24px;
            color: #1877F2;
            /* Màu sắc chính của Facebook */
        }

        .comments {
            margin-top: 15px;
        }

        .comment {
            background-color: #f0f2f5;
            /* Màu nền của mỗi comment */
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Tạo hiệu ứng shadow */
        }

        .comment-header {
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: bold;
            color: #050505;
            /* Màu chữ của tên người dùng */
        }

        .comment-date {
            font-size: 14px;
            color: #65676B;
            /* Màu chữ của ngày đăng comment */
        }

        .comment-body {
            margin-top: 5px;
        }

        .comment-text {
            color: #050505;
            /* Màu chữ của nội dung comment */
        }

        .comment-actions {
            margin-top: 10px;
        }

        .delete-button {
            color: #1877F2;
            /* Màu chữ của nút xóa comment */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .delete-button:hover {
            color: #3b5998;
            /* Màu khi hover của nút xóa comment */
        }

        .delete-button:hover {
            cursor: pointer;
            color: red;
        }

        .contact-info {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2 {
            color: #333;
        }

        .contact-info p {
            margin: 10px 0;
        }

        img {
            object-fit: cover;
        }

        .color_like {
            color: #1877F2;
        }

        .star-rating .fas {
            color: gold !important;
            /* Màu vàng của ngôi sao khi được chọn */
        }

        .star-ratings .fas {
            color: gold !important;
            /* Màu vàng của ngôi sao khi được chọn */
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container">
        <h1 class="text-center" style="margin: 3rem;"><strong style="color: red">Thông tin chi tiết sản phẩm</strong></h1>
        <div class="row">
            <div class="col-sm-4">
                <img src="{{ asset($book->URL) }}" class="img-responsive" alt="Product Image"
                    style="height: 431px;object-fit: cover;">
            </div>
            <input type="text" class="add_val" value="{{ $roundedAverage }}" hidden>
            <div class="col-sm-4">
                <div class="product-details">
                    <h1 style="text-transform: uppercase"><strong>{{ $book->TenSach }}</strong></h2>
                        <div class="description">
                            <h4><strong>Giới thiệu: </strong> {{ $book->MoTa }}</h4>
                        </div>
                        <div>
                            <h4>Tác giả : <strong style="color: lightskyblue">{{ $book->TacGia }}</strong></h4>
                        </div>
                        <div class="star-ratings">
                            <h4><strong>Xếp loại đánh giá</strong></h4>
                            <div class="add_star">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $roundedAverage)
                                        <i class="fas fa-star" data-rating="{{ $i }}"></i>
                                        <!-- Hiển thị sao filled nếu $i nhỏ hơn hoặc bằng $roundedAverage -->
                                    @else
                                        <i class="far fa-star" data-rating="{{ $i }}"></i>
                                        <!-- Hiển thị sao unfilled nếu $i lớn hơn $roundedAverage -->
                                    @endif
                                @endfor
                            </div>
                            <span class="quantity">({{ $count }} đánh giá)</span>
                            @if (!Auth::check())
                                <a href="{{ route('login') }}">click để đánh giá</a>
                            @else
                                <button type="button" data-toggle="modal" data-target="#ratingModal">đánh giá</button>
                            @endif
                        </div>
                        <div class="price">
                            <h1 style="color: red">{{ $book->Gia }} đ</h1>
                        </div>
                        <h4><strong>Vận chuyển:</strong></h4>
                        <p>Giảm 30% phí vận chuyển bởi Nhất Tín Express (NTX)</p>
                        <div class="availability">
                            <h4><strong>Số lượng còn lại : </strong>{{ $book->SoLuongTrongKho }}</h4>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('cart') }}" class="btn btn-danger" onclick="add_produce()"><i
                                    class="fas fa-money-bill-alt"></i> Mua ngay</a>
                            <button class="btn btn-warning drop" id="add_don" onclick="add_produce()">Thêm vào giỏ hàng <i
                                    class="fa fa-shopping-cart"></i></button>

                            <div class="check_like">
                                @if ($check_like)
                                    <i class="fas fa-thumbs-up color_like" onclick="check_like(1,{{ $book->id }})"></i>
                                    <span style="color: #1877F2">Đã thích</span>
                                @else
                                    <i class="fas fa-thumbs-up" onclick="check_like(0,{{ $book->id }})"></i> <span
                                        style="color: #1877F2">Thích</span>
                                @endif

                            </div>
                            {{-- <span id="sodonhang" style="color: red;">0</span> --}}
                        </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2>Thông Tin Liên Hệ</h2>
                    <p><strong>Email:</strong> example@example.com</p>
                    <p><strong>Điện thoại:</strong> +123456789</p>
                    <p><strong>Địa chỉ:</strong> 123 Đường ABC, Thành phố XYZ</p>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="comment-form">
            <h2>Nhận xét</h2>
            <form id="commentForm">
                <textarea id="commentInput" class="form-control" rows="3" placeholder="Viết nhận xét của bạn ở đây...."></textarea>
                <br>
                @if(Auth::check())
                    <button type="button" onclick="comment()" class="btn btn-primary">Bình luận</button>
                @else
                    <a href="{{route("login")}}" class="btn btn-primary">Bình luận</a>
                @endif
            </form>
        </div>
        <div class="comment-section">
            <div class="comments">
                @foreach ($comment as $item)
                    <div class="comment chang_cm_{{ $item->id }}">
                        <div class="comment-header">
                            <img class="avatar" src="{{ asset($item->user->URL) }}" alt="">
                            <div class="user-info">
                                <span class="user-name">{{ $item->user->name }}</span>
                                <span class="comment-date">{{ $item->created_at }}</span>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p class="comment-text">{{ $item->comment }}</p>
                        </div>
                        <div class="comment-actions">
                            <a onclick="deletecomment({{ $item->id }})" class="delete-button">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    {{-- Modal đánh giá sao --}}

    <!-- Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ratingModalLabel">Đánh giá sao</h4>
                </div>
                <div class="modal-body">
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $roundedAverage)
                                <i class="fas fa-star" data-rating="{{ $i }}"></i>
                                <!-- Hiển thị sao filled nếu $i nhỏ hơn hoặc bằng $roundedAverage -->
                            @else
                                <i class="far fa-star" data-rating="{{ $i }}"></i>
                                <!-- Hiển thị sao unfilled nếu $i lớn hơn $roundedAverage -->
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="evalueat({{ $book->id }})">Gửi đánh
                        giá</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->

    <script type="text/javascript">
        function add_produce() {
            var productId = {{ $book->id }};
            // Gửi yêu cầu AJAX đến route '/add-to-cart'
            fetch('add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        productId: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                    $("#sodonhang").html(data.cartCount);
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }

        function comment() {
            let comment = $("#commentInput").val();
            let id_book = {{ $book->id }};
            let id_user = '';
            @if (Auth::check())
                id_user = "{{ Auth::user()->id }}";
            @endif
            fetch('comment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        id_book: id_book,
                        id_user: id_user,
                        comment: comment

                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                    $("#commentInput").val("");
                    var baseUrl = "{{ asset('') }}";
                    var basel = baseUrl + data.user.URL;
                    console.log(data)
                    let reload = `
                                    <div class="comment chang_cm_${data.comment.id}">
                                        <div class="comment-header">
                                            <img class="avatar" src="${data.user.URL}" alt="">
                                            <div class="user-info">
                                                <span class="user-name">${data.user.name}</span>
                                                <span class="comment-date">${data.comment.created_at}</span>
                                            </div>
                                        </div>
                                        <div class="comment-body">
                                            <p class="comment-text">${data.comment.comment}</p>
                                        </div>
                                        <div class="comment-actions">
                                            <a onclick="(deletecomment(${data.comment.id}))" class="delete-button">Delete</a>
                                        </div>
                                    </div>
                                 `
                    $(".comments").before(reload);
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }

        function deletecomment(id) {
            fetch('deletecomment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                    $(`.chang_cm_${data}`).remove();
                    // document.getElementById('sodonhang').innerText = data.cartCount;
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }

        $('.drop').click(function() {
            var $aImg = $('.img-responsive');

            // Lấy vị trí của ảnh trong .a
            var aOffset = $aImg.offset();

            // Tính toán khoảng cách di chuyển
            var deltaX = $('.drap').offset().left - aOffset.left;
            var deltaY = $('.drap').offset().top - aOffset.top;

            // Di chuyển ảnh từ .a đến .b
            $aImg.clone().appendTo('body').css({
                'position': 'absolute',
                'left': aOffset.left,
                'top': aOffset.top,
                'opacity': 1,
                'transform': 'scale(1)'
            }).animate({
                left: '+=' + deltaX,
                top: '+=' + deltaY,
                opacity: 0,
                transform: 'scale(0.5)'
            }, {
                duration: 2000,
                step: function(now, fx) {
                    $(this).css('transform', 'scale(' + now + ')');
                },
                complete: function() {
                    $(this).remove();
                }
            });
        });

        function check_like(check, idbook) {
            fetch('check_like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        check: check,
                        idbook: idbook,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.check == 1) {
                        let icon =
                            `<i class="fas fa-thumbs-up color_like" onclick="check_like(1,${data.idbook})"></i> <span style="color: #1877F2">Đã thích</span>`;
                        $(".check_like").html(icon);
                    } else {
                        let icon =
                            `<i class="fas fa-thumbs-up" onclick="check_like(0,${data.idbook})"></i> <span style="color: #1877F2">Thích</span>`
                        $(".check_like").html(icon);
                    }

                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }


        $(document).ready(function() {
            // Xử lý khi click vào ngôi sao
            $('.star-rating i').click(function() {
                var rating = $(this).data('rating');
                // Đặt lại tất cả các ngôi sao trước đó
                $('.star-rating i').removeClass('fas').addClass('far');
                // Đặt các ngôi sao được click và các ngôi sao trước đó thành sao đã chọn (fas)
                $(this).prevAll('i').addBack().removeClass('far').addClass('fas');
                // Gửi giá trị đánh giá đi, ví dụ: alert(rating);
                $(".add_val").val(rating);
                // console.log(rating)
            });
        });

        function evalueat(id_book) {
            let valevalueat = $(".add_val").val();
            // console.log()
            fetch('evalueat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        valevalueat: valevalueat,
                        id_book: id_book,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let stars = ''; // Khởi tạo một chuỗi để chứa HTML của các ngôi sao
                    for (let i = 1; i <= 5; i++) {
                        let star = document.createElement('i');
                        star.setAttribute('data-rating', i);
                        if (i <= data.roundedAverage) {
                            star.classList.add('fas', 'fa-star');
                        } else {
                            star.classList.add('far', 'fa-star');
                        }
                        stars += star.outerHTML; // Thêm HTML của ngôi sao vào chuỗi stars
                    }

                    // Đưa chuỗi HTML chứa các ngôi sao vào phần tử có class là "add_star"
                    $('.add_star').html(stars);
                    let sl = data.count + ' ( đánh giá )';
                    $('.quantity').html(sl);

                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }
    </script>
@stop
