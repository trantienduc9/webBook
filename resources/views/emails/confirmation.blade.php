<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư phản hồi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
            line-height: 1.5;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999999;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            border: none;
            color: white;
            text-align: center;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        @if ($check_comfirm == 1)
            <h2>Xác nhận đăng ký tài khoản</h2>
            <p><strong>Kính gửi:</strong> {{ $email }}</p>
            <p>Xin chào bạn,</p>
            <p>Chúc mừng! Tài khoản của bạn đã được đăng ký thành công trên trang web của chúng tôi.</p>
            <p>Bạn đã trở thành thành viên của cộng đồng của chúng tôi và sẽ có cơ hội trải nghiệm nhiều dịch vụ và tính
                năng hấp dẫn.</p>
            <p>Nhấn vào nút bên dưới để đăng nhập và bắt đầu sử dụng tài khoản của bạn:</p>
            <a href="https://www.facebook.com/profile.php?id=100023278912819" class="button">Thông tin liên hệ</a>
            <p>Xin hãy giữ thông tin đăng nhập của bạn an toàn và không chia sẻ với người khác.</p>
            <div class="footer">
                <p>Trân trọng,</p>
                <p>Đội ngũ hỗ trợ của chúng tôi</p>
            </div>
        @else
            <h2>Xác nhận đăng ký tài khoản</h2>
            <p>Xin chào bạn,</p>
            <p>Rất tiếc! Yêu cầu xác nhận tài khoản của bạn đã bị từ chối.</p>
            <p>Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi thông qua nút dưới đây:
            </p>
            <a href="https://www.facebook.com/profile.php?id=100023278912819" class="button">Liên hệ với chúng tôi</a>
            <div class="footer">
                <p>Trân trọng,</p>
                <p>Đội ngũ hỗ trợ của chúng tôi</p>
            </div>
        @endif
    </div>
</body>

</html>
