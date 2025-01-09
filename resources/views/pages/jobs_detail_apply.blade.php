@extends('dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .jda-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
        margin-top: 100px;
    }

    .jda-card {
        background: white;
        border: 2px solid #ccc;
        border-radius: 1rem;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .jda-card-header {
        position: relative;
        padding: 2rem;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border-bottom: 2px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jda-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #2563eb, #3b82f6);
    }

    .jda-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .jda-title {
        font-size: 1.875rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .jda-subtitle {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: left;
    }

    .jda-status-badge {
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-weight: 500;
        background-color: #007bff;
        color: white;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .active-status {
        background-color: rgb(75, 203, 120);
    }

    .rejected-status {
        background-color: rgb(192, 78, 78);
    }

    .pending-status {
        background-color: rgb(150, 150, 150);
    }

    .in-progress-status {
        background-color: #007bff;
    }

    .jda-date {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 4rem;
        text-align: right;
    }

    .jda-card-body {
        padding: 2rem;
    }

    .jda-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .jda-section {
        margin-bottom: 2rem;
    }

    .jda-section-title {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #e2e8f0;
        color: #2563eb;
        font-weight: 600;
        font-size: 1.25rem;
        border-bottom: 2px solid #ccc;
    }

    .jda-section-title i {
        margin-right: 0.75rem;
    }

    .jda-image-box {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .jda-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .jda-image {
        cursor: pointer;
        width: 150px;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .jda-image:hover {
        transform: scale(1.1);
    }

    .jda-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .jda-info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jda-info-item:last-child {
        border-bottom: none;
    }

    .jda-info-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: white;
        border: 2px solid #2563eb;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: #2563eb;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .jda-info-content {
        flex: 1;
    }

    .jda-info-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .jda-info-value {
        color: #64748b;
    }

    .jda-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .jda-skill-badge {
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 9999px;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .jda-skill-badge:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-1px);
    }

    .jda-description-box {
        margin-top: 1rem;
        position: relative;
        width: 100%;
    }

    .jda-description {
        width: 100%;
        height: 150px;
        padding: 1rem;
        border: 2px solid #ccc;
        border-radius: 0.5rem;
        background-color: #f8fafc;
        font-size: 1rem;
        color: #475569;
        resize: vertical;
        overflow: auto;
    }

    .jda-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .jda-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: 2px solid transparent;
        transition: all 0.2s;
    }

    .jda-btn-success {
        background: rgb(29, 216, 32);
        color: white;
        border-color: rgb(29, 216, 32);
    }

    .jda-btn-success:hover {
        background: rgb(80, 245, 143);
        color: black;
        border-color: rgb(80, 245, 143);
        transform: translateY(-1px);
    }

    .jda-btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
    }

    .jda-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-1px);
    }

    .jda-CV {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .jda-CVfile {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    @media (max-width: 768px) {
        .jda-grid {
            grid-template-columns: 1fr;
        }

        .jda-header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .jda-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="jda-container">
    <div class="jda-card">
        <!-- Header -->
        <div class="jda-card-header">
            <div class="jda-header-content">
                <div>
                    <h1 class="jda-title">{{ $post->title }}</h1>
                    <h2 class="jda-subtitle">Nhà tuyển dụng: {{ $post->employer->employer_name }}</h2>
                </div>
                <div>
                    <span class="jda-status-badge 
                        @if ($post->status == 'Active') 
                            active-status 
                        @elseif ($post->status == 'Rejected') 
                            rejected-status 
                        @elseif ($post->status == 'InProgress') 
                            in-progress-status 
                        @else 
                            pending-status 
                        @endif">
                        @if($post->status == 'Active')
                        Hoạt động
                        @elseif($post->status == 'Rejected')
                        Bị từ chối
                        @elseif($post->status == 'Pending')
                        Đang chờ
                        @elseif($post->status == 'InProgress')
                        Đang thực hiện
                        @endif
                    </span>
                    <div class="jda-date">Đăng ngày: {{$post->created_at ? date('d/m/Y', strtotime($post->created_at)) : 'Không có' }}</div>
                </div>
            </div>
        </div>
        <!-- Body -->
        <div class="jda-card-body">
            <div class="jda-grid">
                <!-- Main Content -->
                <div class="jda-main-content">
                    <!-- Job Overview -->
                    <div class="jda-section">
                        <div class="jda-section-title">
                            <i class="fas fa-briefcase"></i>
                            Tổng quan
                        </div>
                        <div class="jda-info-box">
                            <div class="jda-info-item">
                                <div class="jda-info-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="jda-info-content">
                                    <div class="jda-info-label">Vị trí</div>
                                    <div class="jda-info-value">{{ $post->position }}</div>
                                </div>
                            </div>
                            <div class="jda-info-item">
                                <div class="jda-info-icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="jda-info-content">
                                    <div class="jda-info-label">Danh mục</div>
                                    <div class="jda-info-value">{{ $post->category->category_name }}</div>
                                </div>
                            </div>
                            <div class="jda-info-item">
                                <div class="jda-info-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="jda-info-content">
                                    <div class="jda-info-label">Khu vực</div>
                                    <div class="jda-info-value">{{ $post->area }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Description -->
                    <div class="jda-section">
                        <div class="jda-section-title">
                            <i class="fas fa-align-left"></i>
                            Mô tả công việc
                        </div>
                        <div class="jda-description-box">
                            <textarea class="jda-description" readonly>
                            {{ $post->description }}
                            </textarea>
                        </div>
                    </div>
                    <!-- Skills -->
                    <div class="jda-section">
                        <div class="jda-section-title">
                            <i class="fas fa-code"></i>
                            Kỹ năng yêu cầu
                        </div>
                        <div class="jda-skills">
                            @foreach($post->skills as $skill)
                            <span class="jda-skill-badge">{{ $skill->skill_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="jda-sidebar">
                    <div class="jda-section">
                        <div class="jda-section-title">
                            <i class="fas fa-info-circle"></i>
                            Thông tin bổ sung
                        </div>
                        <div class="jda-info-box">
                            <div class="jda-info-item">
                                <div class="jda-info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="jda-info-content">
                                    <div class="jda-info-label">Ngày hết hạn bài đăng</div>
                                    <div class="jda-info-value">
                                        {{ $post->expiration_date ? date('d/m/Y', strtotime($post->expiration_date)) : 'Không có' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jda-section">
                        <div class="jda-section-title">
                            <i class="fas fa-image"></i>
                            Hình ảnh
                        </div>
                        <div class="jda-image-box">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                alt="Ảnh đại diện"
                                class="jda-image"
                                id="profileImage"
                                data-bs-toggle="modal"
                                data-bs-target="#imageUpdateModal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jda-card-footer">
            <a href="{{ route('job_index') }}" class="jda-btn jda-btn-secondary">
                Quay lại
            </a>
            <div class="jda-CV">
                <form class="jda-CVfile" id="uploadForm" action="{{ route('jobs_apply', $post->post_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="cv_file" id="fileInput" require>
                    <button type="submit" class="jda-btn jda-btn-success" onclick="handleUpload()">Ứng tuyển</button>
                </form>
            </div>
        </div>
    </div>
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
            window.location.href = "{{ route('home') }}";
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
<script>
    function handleUpload() {
        const formData = new FormData(document.getElementById('uploadForm'));

        fetch('/cv/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra');
            });
    }
</script>
@endsection