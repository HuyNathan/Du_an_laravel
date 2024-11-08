<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
      body {
    background-color: #000;
    margin: 0; /* Đảm bảo không có margin cho body */
    height: 100vh; /* Chiều cao đầy đủ cho body */
    display: flex; /* Sử dụng Flexbox */
    justify-content: center; /* Căn giữa theo chiều ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
}

body.login-page {
    background-color: black;
}
      /* Tăng kích thước chữ đăng nhập */
      .login-box-msg {
          font-size: 24px; /* Tăng kích thước chữ */
          font-weight: bold; /* Làm cho chữ đậm */
          text-align: center; /* Căn giữa chữ */
          margin-bottom: 20px; /* Khoảng cách dưới chữ */
      }

      /* Tăng kích thước nút Sign In */
      .btn-primary {
          font-size: 16px; /* Tăng kích thước chữ trong nút */
          padding: 10px; /* Tăng khoảng cách trong nút */
      }

      /* Tạo hiệu ứng cầu vồng chạy đuổi theo chiều kim đồng hồ */
      .login-box {
    position: relative;
    width: 100%;
    max-width: 400px;
    padding: 20px;
    border-radius: 10px;
    background-color: #fff; /* Nền trắng cho form login */
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    overflow: hidden;
    margin-bottom: 250px; /* Loại bỏ margin negative */
}


      /* Tạo một lớp phủ cho hiệu ứng cầu vồng chạy đuổi */
      .login-box::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 10px;
        background: linear-gradient(270deg, red, orange, yellow, cyan, blue, violet);
        z-index: -5; /* Đặt lớp phủ ở phía sau box */
        animation: rainbowBorder 35s linear forwards; /* Tăng tốc độ animation */
        background-size: 300% 300%; /* Tăng kích thước gradient */
      }

      /* Animation để tạo hiệu ứng chạy đuổi */
      @keyframes rainbowBorder {
        0% {
          background-position: 0% 50%; /* Vị trí ban đầu */
        }
        100% {
          background-position: 100% 50%; /* Vị trí cuối cùng */
        }
      }
      button.btn.btn-primary.btn-block {
        background: red;
        border: none; /* Loại bỏ viền mặc định */
        outline: none; /* Loại bỏ viền khi nhấn */
      }

      button.btn.btn-primary.btn-block:focus {
        outline: none; /* Đảm bảo không có viền khi nhấn */
      }

      /* Đảm bảo box login có nền trắng */
      .card-primary.card-outline {
        background-color: transparent; /* Để nền trong suốt cho box */
        border: none; /* Không có đường viền */
      }

      .card-header {
        background-color: transparent;
        border-bottom: none;
      }
    </style>
</head>
<body class="login-page">
    <div class="login-box">
        <p class="login-box-msg">Đăng Nhập</p>
        <!-- Form đăng nhập của bạn ở đây -->
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật Khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
        </form>
        <p class="mt-3 text-center">
            <a href="{{ route('user.register.store') }}">Đăng ký</a>
        </p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
