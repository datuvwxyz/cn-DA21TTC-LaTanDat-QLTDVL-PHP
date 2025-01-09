<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Trang chủ</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/aos/aos.css" rel="stylesheet')}}">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="{{ asset('backend/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- Pages CSS -->
  <link href="{{ asset('frontend/css/home.css')}}" rel="stylesheet">

  <!-- Tích hợp CDN để sử dụng icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="index-page">

  <!-- Header  -->

  @include('components.header')

  <!-- End Header -->

  <main class="main">

    <!-- Hero Section -->

    @if(Route::currentRouteName() === 'dashboard')
      @include('components.section_hero')
      @include('components.hero_content')
    @endif

    <!-- End Hero Section -->

    @yield('content')

  </main>

  <!-- Footer -->

  @include('components.footer')

  <!-- End Footer -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/js/main.js') }}"></script>

  <!-- DataTables JavaScript -->
  <script src="{{ asset('backend/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/admin/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
  
</body>

</html>