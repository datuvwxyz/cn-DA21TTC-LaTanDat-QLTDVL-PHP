<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đăng ký</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{asset('frontend/css/register.css')}}">
</head>

<body>
  <div class="form-container">
    <form method="POST" action="{{ route('post_register') }}">
      @csrf
      <h3>Đăng ký</h3>
      <label for="username">Tên đăng nhập</label>
      <div class="form-group">
        <input type="text" class="form-control form-control-user" name="user_name" placeholder="Tên đăng nhập" required="">
      </div>
      <label for="email">Email</label>
      <div class="form-group">
        <input type="email" class="form-control form-control-user" name="email" placeholder="Email" required="">
      </div>
      <label for="phone">Số điện thoại</label>
      <div class="form-group">
        <input type="text" class="form-control form-control-user" name="tel" placeholder="Số điện thoại" required="">
      </div>
      <label for="password">Mật khẩu</label>
      <div class="form-group">
        <input type="password" class="form-control form-control-user" name="password" placeholder="Mật khẩu" required="">
      </div>
      <label for="confirm-password">Nhập lại mật khẩu</label>
      <div class="form-group">
        <input type="password" class="form-control form-control-user" name="confirm_password" placeholder="Nhập lại mật khẩu" required="">
      </div>
      <div class="form-group">
        <select class="form-control form-control-user" name="role" required="">
          <option value="freelancer">Freelancer</option>
          <option value="employer">Nhà tuyển dụng</option>
        </select>
      </div>
      <button type="submit">Đăng ký</button>
      <div class="backhome"><a href="{{ route('dashboard') }}">Quay về trang chủ</a></div>
    </form>
  </div>
  @if(Session::has('success'))
  <script>
    Swal.fire({
      title: "Thành công!",
      text: "{{ Session::get('success') }}",
      icon: "success",
      confirmButtonText: "OK"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "{{ route('login') }}";
      }
    });
  </script>
  @endif

  @if(Session::has('error'))
  <script>
    Swal.fire({
      title: "Thất bại!",
      text: "{{ Session::get('error') }}",
      icon: "error",
      confirmButtonText: "Thử lại"
    });
  </script>
  @endif
</body>

</html>