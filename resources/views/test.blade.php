<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Thông Tin Tài Khoản</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .dropdown-toggle {
            position: relative;
        }

        .dropdown-toggle .caret {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 200px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .dropdown-menu li {
            list-style: none;
            margin-bottom: 10px;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .dropdown-menu a i,
        .dropdown-menu button i {
            margin-right: 10px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            color: #fff;
            background-color: #007bff;
        }

        .dropdown-menu button {
            padding: 5px 10px;
        }

        .dropdown-menu button.btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .dropdown-menu button.btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fas fa-user"></i> Thông tin tài khoản <span class="caret"></span>
        </button>
        <ul id="dropdownMenu" class="dropdown-menu">
            <!-- Thêm nội dung của menu thông tin tài khoản ở đây -->
            <li><a href="#"><i class="fas fa-edit"></i> Chỉnh sửa thông tin</a></li>
            <li><button class="btn btn-danger" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
            </li>
        </ul>
    </div>

    <script>
        $(document).ready(function() {
            $(".dropdown-toggle").click(function() {
                $("#dropdownMenu").slideToggle();
            });
        });

        function logout() {
            // Thêm code xử lý khi người dùng đăng xuất ở đây
            alert("Bạn đã đăng xuất thành công!");
        }
    </script>

</body>

</html>
