@extends('dashboard')

@section('content')
<style>
    .banner-slider {
        position: relative;
        width: 100%;
        max-height: 600px;
        overflow: hidden;
        background-color: #f4f4f4;
    }

    .banner-slider img {
        width: 100%;
        height: auto;
        display: block;
    }

    .introduce-section {
        max-width: 800px;
        margin: 2rem auto;
        padding: 1rem;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .introduce-section h2 {
        color: #0078d4;
        margin-bottom: 1rem;
        font-size: 2rem;
    }

    .introduce-section p {
        margin: 1rem 0;
        font-size: 1.1rem;
    }

    .introduce-team {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
    }

    .introduce-member {
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        width: 200px;
    }

    .introduce-member img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-bottom: 0.5rem;
    }

    .introduce-member h3 {
        margin: 0.5rem 0;
        font-size: 1.2rem;
        color: #0078d4;
    }
</style>
<div class="banner-slider">
    <img src="{{asset('frontend/img/banner-freelancer.png')}}" alt="Banner" />
</div>
<section class="introduce-section">
    <h2> Chào mừng đến với nền tảng Freelancer</h2>
    <p>
        Trang web của chúng tôi là nơi kết nối những người tài năng với các doanh nghiệp, tổ chức và cá nhân có nhu cầu thuê dịch vụ. Dù bạn là một freelancer đang tìm kiếm cơ hội mới, hay một nhà tuyển dụng muốn hoàn thành dự án của mình một cách nhanh chóng và hiệu quả, chúng tôi luôn sẵn sàng đồng hành.
        Với giao diện thân thiện, các công cụ tìm kiếm dự án tiện lợi và hệ thống đánh giá minh bạch, bạn sẽ dễ dàng tìm được đối tác phù hợp. Hãy tham gia ngay hôm nay để khám phá cơ hội mới và đạt được thành công trong lĩnh vực mà bạn đam mê!
    </p>
    <p>
        Dù bạn đang tìm kiếm một lập trình viên web tài năng, một nhà thiết kế đồ họa sáng tạo, hay một cây bút nội dung đáng tin cậy, Web Freelancer đều có thể đáp ứng nhu cầu của bạn.
    </p>
</section>

<section class="introduce-section">
    <h2>Meet Our Team</h2>
    <div class="introduce-team">
        <div class="introduce-member">
            <img src="https://via.placeholder.com/100" alt="Team Member">
            <h3>Jane Doe</h3>
            <p>Founder & CEO</p>
        </div>
        <div class="introduce-member">
            <img src="https://via.placeholder.com/100" alt="Team Member">
            <h3>John Smith</h3>
            <p>Lead Developer</p>
        </div>
        <div class="introduce-member">
            <img src="https://via.placeholder.com/100" alt="Team Member">
            <h3>Emily Johnson</h3>
            <p>Project Manager</p>
        </div>
    </div>
</section>
@endsection