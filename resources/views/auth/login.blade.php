<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Đăng nhập</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--Stylesheet-->
  <link rel="stylesheet" href="{{asset('frontend/css/login.css')}}">
</head>

<body>
  <form method="POST" action="{{ route('post_login') }}">
    @csrf
    <h3>Đăng nhập</h3>
    <label for="username">Tên đăng nhập</label>
    <div class="form-group">
      <input type="text" class="form-control form-control-user" name="email" placeholder="Tên đăng nhập" required="">
    </div>
    <label for="password">Mật khẩu</label>
    <div class="form-group">
      <input type="password" class="form-control form-control-user" name="password" placeholder="Mật khẩu" required="">
    </div>
    <button type="submit">Đăng nhập</button>
    <div class="social">
      <div class="go"><i class="fab fa-google"></i> Google</div>
      <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
    </div>
    <div class="register"><a href=" {{ route('register') }}">Đăng ký</a></div>
    <div class="backhome"><a href="{{ route('dashboard') }}">Quay lại trang chủ</a></div>
  </form>
  <input type="hidden" value="{{session('user_role')}}"  id="user-role">
  @if(Session::has('success'))
  <script>
    Swal.fire({
      title: "Thành công!",
      text: "{{ Session::get('success') }}",
      icon: "success",
      confirmButtonText: "OK"
    }).then((result) => {
      if (result.isConfirmed) {
        const userRole = document.getElementById('user-role').value;
        if (userRole === 'admin') {
          window.location.href = "{{ route('admin_dashboard') }}";
        } else if (userRole === 'freelancer') {
          window.location.href = "{{ route('home') }}";
        } else if (userRole === 'employer') {
          window.location.href = "{{ route('home') }}";
        } else {
          window.location.href = "{{ route('home') }}";
        }
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