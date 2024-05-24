<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>
    <!-- Thêm các tài nguyên CSS của bạn tại đây -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite(['resources/js/app.js'])
    @yield('header_styles')
    <style>
        .css_sb {
            position: fixed !important;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: #3699ee;
            border: none;
        }

        .colo {
            color: white !important;
        }

        .colo:hover {
            color: blue !important;
        }

        /* CSS cho phần footer */
        .footer {
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            padding: 50px 0;
            margin-top: 5rem;
        }

        .footer h2 {
            color: #333;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer p {
            color: #555;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: #555;
            font-size: 16px;
        }

        .footer ul li a:hover {
            color: #007bff;
        }

        /* CSS cho bản đồ Google Maps */
        #map {
            width: 100%;
            height: 200px;
            /* Độ cao của bản đồ */
            border-radius: 5px;
            margin-top: 20px;
        }


        .dropbtn {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Dropdown button on hover */
        .dropbtn:hover {
            background-color: #2980b9;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu */
        .show {
            display: block;
        }

        .nav-side-menu {
            overflow: auto;
            font-family: verdana;
            font-size: 12px;
            font-weight: 200;
            background-color: #3699ee;
            position: fixed;
            top: 5;
            width: 16%;
            height: 100%;
            color: #e1ffff;
            /* z-index: -1; */
        }

        .nav-side-menu .brand {
            background-color: #23282e;
            line-height: 50px;
            display: block;
            text-align: center;
            font-size: 14px;
        }

        .nav-side-menu .toggle-btn {
            display: none;
        }

        .nav-side-menu ul,
        .nav-side-menu li {
            list-style: none;
            padding: 0px;
            margin: 0px;
            line-height: 35px;
            cursor: pointer;
        }

        .nav-side-menu ul :not(collapsed) .arrow:before,
        .nav-side-menu li :not(collapsed) .arrow:before {
            font-family: FontAwesome;
            content: "\f078";
            display: inline-block;
            padding-left: 10px;
            padding-right: 10px;
            vertical-align: middle;
            float: right;
        }

        .nav-side-menu ul .active,
        .nav-side-menu li .active {
            border-left: 3px solid #d19b3d;
            background-color: #4f5b69;
        }

        .nav-side-menu ul .sub-menu li.active,
        .nav-side-menu li .sub-menu li.active {
            color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li.active a,
        .nav-side-menu li .sub-menu li.active a {
            color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li,
        .nav-side-menu li .sub-menu li {
            background-color: #181c20;
            border: none;
            line-height: 28px;
            border-bottom: 1px solid #23282e;
            margin-left: 0px;
        }

        .nav-side-menu ul .sub-menu li:hover,
        .nav-side-menu li .sub-menu li:hover {
            background-color: #020203;
        }

        .nav-side-menu ul .sub-menu li:before,
        .nav-side-menu li .sub-menu li:before {
            font-family: FontAwesome;
            content: "\f105";
            display: inline-block;
            padding-left: 10px;
            padding-right: 10px;
            vertical-align: middle;
        }

        .nav-side-menu li {
            padding-left: 0px;
            border-left: 3px solid #2e353d;
            border-bottom: 1px solid #23282e;
        }

        .nav-side-menu li a {
            text-decoration: none;
            color: #e1ffff;
        }

        .nav-side-menu li a i {
            padding-left: 10px;
            width: 20px;
            padding-right: 20px;
        }

        .nav-side-menu li:hover {
            border-left: 3px solid #d19b3d;
            background-color: #4f5b69;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
        }

        @media (max-width: 767px) {
            .nav-side-menu {
                position: relative;
                width: 100%;
                margin-bottom: 10px;
            }

            .nav-side-menu .toggle-btn {
                display: block;
                cursor: pointer;
                position: absolute;
                right: 10px;
                top: 10px;
                z-index: 10 !important;
                padding: 3px;
                background-color: #ffffff;
                color: #000;
                width: 40px;
                text-align: center;
            }

            .brand {
                text-align: left !important;
                font-size: 22px;
                padding-left: 20px;
                line-height: 50px !important;

            }
        }

        @media (min-width: 767px) {
            .nav-side-menu .menu-list .menu-content {
                display: block;
            }
        }

        .dropdown-menu {
            padding: 23px;
            line-height: 4;
            width: 22rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            display: none;
        }

        .navbar-nav {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .navbar-nav .active {
            height: 100%;
            align-items: center;

        }

        .navbar-nav .active a {
            height: 100%;
            align-items: center;
            background: #ff0076 !important;

        }

        .navbar-nav a {
            color: white !important;

        }

        .navbar-nav .css_al {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .container-fluid {
            height: 60px;
        }

        #menu-content .active {
            background: #ff0076 !important;
        }

        #menu-content li {
            border: none;
        }
    </style>
</head>

<body>
    <div class="all_css">

        <nav class="navbar navbar-inverse css_sb">
            <div class="container-fluid" style="display: flex;align-items: center;justify-content: space-between;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('index') }}" style="color: white; margin-left: -206px ">
                        <img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/fahasa-logo.png"
                            alt="" width="130px">
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="change_url"><a href="{{ route('index') }}" class="css_al">Trang chủ</a></li>
                    @if (Auth::check())
                        <li class="change_url"><a href="{{ route('list_order') }}" class="css_al">Đơn hàng</a></li>
                    @endif
                    @if ($admin)
                        <li class="change_url"><a href="{{ route('store') }}" class="css_al">Thêm sách</a></li>
                        <li class="change_url"><a href="{{ route('signup') }}" class="css_al">Tạo tài khoản</a></li>
                        {{-- <li><a href="{{ route('list_acc') }}">Danh sách tài khoản</a></li> --}}
                    @endif
                    <li style="margin-left: 42px">
                        <div style="display: flex;justify-content: center;align-items: center;height: 55px;"
                            class="">
                            <a href="{{ route('cart') }}"
                                style="background: white; padding: 4px;border-radius: 100%;"><i
                                    class="fas fa-shopping-cart drap" style="color: red; font-size: 12px"
                                    id="sodonhang">0</i></a>
                        </div>
                    </li>
                    <li style="margin-left: 30px">
                        <div
                            style="display: flex;justify-content: center;align-items: center;height: 37px;width:37px; background: white; border-radius: 100%">
                            <a href="{{ route('chat') }}">
                                <i class="far fa-comments" style="color: red"></i>
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (!Auth::check())
                        <li><a href="{{ route('signup') }}"><span class="glyphicon glyphicon-user"></span> Đăng ký</a>
                        </li>
                        <li><a href="{{ route('loginreal') }}"><span class="glyphicon glyphicon-log-in"></span> Đăng
                                nhập</a>
                        </li>
                    @else
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fas fa-user"></i> Đăng xuất <span class="caret"></span>
                                </button>
                                <div id="dropdownMenu" class="dropdown-menu">
                                    <!-- Thêm nội dung của menu thông tin tài khoản ở đây -->
                                    <div style="display: flex; justify-content: space-between"><img
                                            style="width: 50px;height: 50px;object-fit: cover; border-radius: 100%;"
                                            src="{{ asset(Auth::User()->URL) }}"
                                            alt="">{{ Auth::User()->name }} <a
                                            href="{{ route('signup') }}?check=1&id={{ Auth::user()->id }}"><i
                                                class="fas fa-edit" style="color: red"></i></a> </div>
                                    <div><a class="btn btn-danger" href="{{ route('logout') }}"><i
                                                class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>

            </div>
        </nav>

        <div style="margin-top: 6rem" class="mtop">

        </div>
        {{-- chat --}}

        <div class="css_menu" style="display: flex;justify-content: center;">
            {{-- left menu --}}
            <div style="width: 15%;" class="left_menu">
                <div class="nav-side-menu">
                    {{-- <div class="brand" style="background: #ff0000">Bán sách</div> --}}
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

                    <div class="menu-list">

                        <ul id="menu-content" class="menu-content collapse out">
                            {{-- <li>
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-dashboard fa-lg"></i> Trang chủ
                                </a>
                            </li> --}}

                            <li data-toggle="collapse" data-target="#products" class="collapsed">
                                <a href="#"><i class="fa fa-gift fa-lg"></i> Thể loại <span
                                        class=""></span></a>
                            </li>
                            <ul class="sub-menu collapse" id="products">
                                @foreach ($list_category as $val_category)
                                    <li style="background: #3699ee"><a
                                            href="{{ route('index', ['id' => $val_category->id]) }}"
                                            style="color: white">{{ $val_category->name }}</a>
                                    </li>
                                @endforeach
                                <li style="background: #3699ee"><a href="{{ route('index') }}" style="color: white">Tất
                                        cả</a></li>
                            </ul>
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('liked') }}">
                                        <i class="fas fa-heart"></i> Đã thích
                                    </a>
                                </li>
                            @endif

                            @if ($admin)
                                <li>
                                    <a href="{{ route('acc_comfirm') }}">
                                        <i class="fas fa-user-check"></i> Xác nhận tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('list_acc') }}">
                                        <i class="fas fa-users"></i> Danh sách tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product_sold') }}">
                                        <i class="fas fa-users"></i> Sản phẩm đã mua
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Nội dung chính của trang -->
            <div class="content" style="width: 85%">
                <main class="py-4">
                    <div id="notification" class="alert mx-4 invisible">
                        Bạn đã đăng nhập thành công
                    </div>
                </main>
                @yield('content')
            </div>
        </div>
    </div>
    <div style="height: 25rem" class="foodt">

    </div>
    <div>
        <footer class="footer" style="position: relative; bottom:0">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Thông tin liên hệ</h2>
                        <p><strong>Email:</strong> contact@example.com</p>
                        <p><strong>Điện thoại:</strong> 0123 456 789</p>
                        <p><strong>Địa chỉ:</strong> Số 123, Đường ABC, Thành phố XYZ</p>
                    </div>
                    <div class="col-md-4">
                        <h2>Theo dõi chúng tôi</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" target="_blank">Facebook</a></li>
                            <li><a href="#" target="_blank">Twitter</a></li>
                            <li><a href="#" target="_blank">Instagram</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h2>Bản đồ</h2>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d232.6731564842549!2d105.81829166143855!3d21.081826399630977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1713495908139!5m2!1sen!2s"
                            width="200" style="border:0; height: auto;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- Replace the following iframe with your Google Maps embed code -->
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.331079522163!2d106.69742031431294!3d10.762075992329033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f08a5010aa7%3A0x72df9b9c9b98968f!2zS2jGsMahbmcgVGjDoG5o!5e0!3m2!1svi!2s!4v1586995846280!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Lấy URL hiện tại
            var currentUrl = window.location.href;

            // Duyệt qua mỗi liên kết và so sánh với URL hiện tại
            $(".navbar-nav .change_url a").each(function() {
                var linkUrl = $(this).attr("href");

                // Nếu URL của liên kết trùng khớp với URL hiện tại, thêm lớp 'active' cho liên kết
                if (currentUrl === linkUrl) {
                    $(this).closest("li").addClass("active");
                }
            });
            $("#menu-content li a").each(function() {
                var linkUrl = $(this).attr("href");

                // Nếu URL của liên kết trùng khớp với URL hiện tại, thêm lớp 'active' cho liên kết
                if (currentUrl === linkUrl) {
                    $(this).closest("li").addClass("active");
                }
            })
        });

        // Hiển thị số lượng trên giỏ hàng
        function update_cart() {
            // Gửi yêu cầu AJAX đến route '/add-to-cart'
            fetch('{{ route('display-to-cart') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                    $("#sodonhang").html(data.cartCount);
                    // document.getElementById('sodonhang').innerText = data.cartCount;
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }
        $(function() {
            update_cart();
        });

        function previewImage() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#display_image').html('<img src="' + e.target.result +
                    '" class="img-fluid mt-2" style="max-width: 100px; height: 98px;object-fit: cover;">');
            }
            reader.readAsDataURL($('#image')[0].files[0]);
        }

        $(document).ready(function() {
            $(".dropbtn").click(function() {
                $("#myDropdown").slideToggle("slow");
            });

            $(document).click(function(event) {
                var $target = $(event.target);
                if (!$target.closest('.dropdown').length &&
                    $('.dropdown-content').is(":visible")) {
                    $("#myDropdown").slideUp("slow");
                }
            });
        });

        @if (Auth::check())
            function infor() {
                // Gửi yêu cầu AJAX đến route '/add-to-cart'

                fetch('{{ route('infor') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                        },
                        body: JSON.stringify({
                            // Dữ liệu bạn muốn gửi đi (nếu cần)
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        let as;
                        let us = `
                            <img src="" alt="">
                        `;
                        $(".acc_inf").html();
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            }
            infor();
        @endif

        $(document).ready(function() {
            $(".dropdown-toggle").click(function() {
                console.log("gh")
                $("#dropdownMenu").slideToggle();
            });
        });

        function logout() {
            // Thêm code xử lý khi người dùng đăng xuất ở đây
            alert("Bạn đã đăng xuất thành công!");
        }

        // gửi tin nhắn chung
        function sendchat() {
            let message = document.querySelector("#message");
            if (message.value.trim() !== "") {

                axios.post('{{ route('postMessage') }}', {
                        message: message.value
                    })
                    .then(function(response) {
                        // console.log(response.data);
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            }
        }

    </script>
    @yield('footer_scripts')
</body>

</html>
