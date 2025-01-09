@extends('dashboard')

@section('content')
<div class="category-container">
  <div class="subtitle">LĨNH VỰC CÔNG VIỆC NỔI BẬT</div>
  <div class="title">Danh mục nghề nghiệp</div>
  <div class="categories">
    <div class="category-card">
      <img src="{{asset('frontend/img/category-icon/computer.png')}}" alt="Công nghệ thông tin">
      <div class="category-name">Công nghệ thông tin</div>
      <div class="job-count">12</div>
    </div>
    <div class="category-card">
      <img src="{{asset('frontend/img/category-icon/apartment.png')}}" alt="Bất động sản">
      <div class="category-name">Bất động sản</div>
      <div class="job-count">5</div>
    </div>
    <div class="category-card">
      <img src="{{asset('frontend/img/category-icon/economic.png')}}" alt="Kinh tế">
      <div class="category-name">Kinh tế</div>
      <div class="job-count">4</div>
    </div>
    <div class="category-card">
      <img src="{{asset('frontend/img/category-icon/law.png')}}" alt="Luật">
      <div class="category-name">Luật</div>
      <div class="job-count">3</div>
    </div>
  </div>
</div>

<div class="banner-slider">
  <img src="{{asset('frontend/img/banner.jpeg')}}" alt="Banner" />
  <div class="overlay"></div>
  <div class="content">
    <div class="text-overlay">Bạn đã hứng thú để tìm việc chưa?</div>
    <a href="/jobs" class="banner-button">Tìm việc ngay</a>
  </div>
</div>

<div class="featured-jobs"> 
  <h2>Công việc nổi bật</h2>
  <div class="job-list">
    <div class="job-card">
      <div class="job-image">
        <img src="{{asset('frontend/img/logo1.png')}}" alt="Logo công ty">
      </div>
      <div class="job-details">
        <h3 class="job-title">Tuyển dụng Backend Developer</h3>
        <div class="job-meta">
          <span class="job-type">Nhân viên</span>
          <span class="job-location">Đà Nẵng</span>
          <span class="job-salary">3 - 5 triệu</span>
        </div>
      </div>
      <div class="job-actions">
        <span class="job-tag internship">Thực tập</span>
        <span class="job-time">Vài giây trước</span>
      </div>
    </div>

    <div class="job-card">
      <div class="job-image">
        <img src="{{asset('frontend/img/logo2.png')}}" alt="Logo công ty">
      </div>
      <div class="job-details">
        <h3 class="job-title">Tuyển dụng Developer</h3>
        <div class="job-meta">
          <span class="job-type">Nhân viên</span>
          <span class="job-location">Bắc Ninh</span>
          <span class="job-salary">Thoả thuận</span>
        </div>
      </div>
      <div class="job-actions">
        <span class="job-tag full-time">Toàn thời gian</span>
        <span class="job-time">Một năm trước</span>
      </div>
    </div>
  </div>
</div>
@endsection