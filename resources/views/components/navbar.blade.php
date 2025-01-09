<nav id="navmenu" class="navmenu">
    <ul>
        @if(!Request::is('dashboard')) <!-- Kiểm tra xem không phải là trang dashboard -->
        <li><a href="{{ route('home') }}">Trang chủ</a></li>
        <li><a href="{{ route('job_index') }}">Việc làm</a></li>
        <li><a href="{{ route('introduce') }}">Giới thiệu</a></li>
        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
        @endif


        @if(session('user_role'))
        <li class="dropdown">
            <div class="profile-circle">
                <img src="{{ session('image') ? asset('storage/' . session('image')) : asset('frontend/img/user.png') }}"
                    style="width: 30px; height: 30px; border-radius: 50%;">
                <span>{{ session('user_name') ?? 'Guest' }}</span>
            </div>
            <ul>
                @if(session('user_role') === 'freelancer')
                <!-- Menu cho Freelancer -->
                <li><a href="{{ route('freelancer_setting') }}">Cài đặt hồ sơ</a></li>
                <li><a href="{{ route('jobs_submited') }}">Công việc đã nộp</a></li>
                @elseif(session('user_role') === 'employer')
                <!-- Menu cho Employer -->
                <li><a href="{{ route('employer_setting') }}">Cài đặt hồ sơ</a></li>
                <li><a href="{{ route('post_job') }}">Đăng tin</a></li>
                <li><a href="{{ route('post_listed') }}">Danh sách tin đã đăng</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </form>
        </li>
    </ul>
    </li>
    @else
    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
    <li><a href="{{ route('register') }}">Đăng ký</a></li>
    @endif

    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>