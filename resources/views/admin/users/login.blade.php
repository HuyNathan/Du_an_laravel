<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.head')  
</head>
<style>
  body {
    background-color: #000;
    margin: 0; /* Đảm bảo không có margin cho body */
    height: 100vh; /* Chiều cao đầy đủ cho body */
  }
  body.login-page {
    background-color: black;
    position: relative;
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
    margin: -15%; /* Căn giữa box */
    top: 50%; /* Đặt box ở giữa trang */
    transform: translateY(-50%); /* Đẩy box lên giữa */
    margin-bottom: 250px;
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
<body class="login-page" style="min-height: 466px;">
<div class="login-box">
  <!-- /.login-logo -->
  <div >
    
    <div class="card-body">
      <p class="login-box-msg">ADMIN</p>
    @include('admin.alert')
      <form action="/admin/users/login/store" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button  type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>
  </div>
</div>

@include('admin.footer')  

</body>
</html>