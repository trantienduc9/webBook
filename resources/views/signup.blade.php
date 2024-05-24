@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    @parent
    <style>
        body {
            /* background-color: #f8f9fa; */
            font-family: Arial, sans-serif;
            background-image: url('https://source.unsplash.com/1600x900/?nature,water');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .containers {
            /* max-width: 400px; */
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .containers h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border-color: #ccc;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 30px;
            color: #999;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ff0000;
        }

        #display_image {
            position: absolute;
            top: 208px;
            left: 172px;
        }
        .imgcheck{
            position: relative;
        }
        /* ẩn thanh header */
        .css_sb{
            display: none;
        }
        /* ẩn thanh left_menu */
        .left_menu{
            display: none;
        }
        /* Ẩn footer */
        .footer{
            display: none;
        }
        .foodt{
            display: none;
        }
        .mtop{
            display: none;
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="containers">
        <div class="imgcheck">
            <h2>Đăng ký tài khoản</h2>
            <div id="display_image">
                <img src="{{asset(isset($inforuser->URL) ? $inforuser->URL : '')}}" class="img-fluid mt-2" style="max-width: 100px; height: 98px;object-fit: cover;" alt="">
            </div>
        </div>
        <form id="registerForm" action="{{ route('check_signup') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id_user" value="{{isset($inforuser->id) ? $inforuser->id : ''}}" hidden>
            <input type="text" value="{{isset($check) ? $check : ''}}" name="check_tt" hidden>
            <input type="text" hidden value="0" name="trangthai">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ isset($inforuser->name) ? $inforuser->name : '' }}"
                    {{ isset($inforuser->name) ? 'disabled' : 'required' }}>
            </div>
            @if ($admin)
                <div class="form-group">
                    <label for="permission">Quyền người dùng</label>
                    <select name="permission" id="permission" class="form-control">
                        <option value="1" {{ isset($RoleUser->role_id) && $RoleUser->role_id == 1 ? 'selected' : '' }}>
                            Admin</option>
                        <option value="3" {{ isset($RoleUser->role_id) && $RoleUser->role_id == 3 ? 'selected' : '' }}>
                            User</option>
                    </select>
                </div>
            @else
                <input type="text" name="permission" id="permission" hidden value="3">
            @endif
            <div class="form-group">
                <label for="image">Avatar</label>
                <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage()">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ isset($inforuser->email) ? $inforuser->email : '' }}"
                    {{ isset($inforuser->email) ? 'disabled' : 'required' }}>
            </div>

                @if ($check != 2)
                    @if ($check == 1)
                        <div class="form-group">
                            <label for="password_old">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="password_old" name="password_old" required>
                            <div class="error-pass" id="passwordoldError" style="color: red"></div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="password">{{ $check == 1 ? 'Mật khẩu mới :' : 'Mật khẩu :' }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                        <div class="error-message" id="passwordError"></div>
                    </div>
                @endif

            <div class="form-group">
                <button type="button" class="btn btn-primary btn-block"
                    onclick="check_pass('{{ isset(Auth::user()->password) ? Auth::user()->password : 5 }}')">{{isset($check) ? 'Cập nhật' : 'Đăng ký'}}</button>
            </div>
            @if(empty($check))
                <div class="login-link">
                    <p>Đã có tài khoản? <a href="{{ route('loginreal') }}">Đăng nhập</a></p>
                </div>
            @endif

            @if(Auth::check())
                <a class="btn btn-danger" href="{{route('index')}}" title="Quay lại"> > </a>
            @endif
        </form>
    </div>

@stop

@section('footer_scripts')
    @parent
    <script>

        function check_pass(check_pass) {
            @if(isset($check))
                @if ($check == 1)
                    var password_old = $('#password_old').val();
                    // Gửi mật khẩu cũ và mật khẩu đã mã hóa của người dùng đến máy chủ bằng Ajax
                    fetch('check_pass', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                            },
                            body: JSON.stringify({
                                // Dữ liệu bạn muốn gửi đi (nếu cần)
                                password_old: password_old,
                                hashed_password: check_pass,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data == 0) {
                                $('#passwordoldError').text("Mật khẩu không chính xác");
                            } else {
                                $('#passwordoldError').text("");
                                // Nếu không có lỗi, kiểm tra mật khẩu mới và submit form
                                check_new_password();
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                @elseif($check != 2)
                    check_new_password();
                    // Kiểm tra mật khẩu mới
                @else
                    $("#registerForm").submit();
                @endif
            @else
                check_new_password();

            @endif
        }

        function check_new_password() {
            var password = $('#password').val();
            var confirmPassword = $('#password_confirm').val();
            if (password !== confirmPassword) {
                $('#passwordError').text('Mật khẩu nhập lại không trùng khớp');
            } else {
                $('#passwordError').text('');
                $("#registerForm").submit();
            }
        }

    </script>
@stop
