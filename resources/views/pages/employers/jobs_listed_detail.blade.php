@extends('dashboard')

@section('content')
<style>
    .jld-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
        margin-top: 100px;
    }

    .jld-card {
        background: white;
        border: 2px solid #ccc;
        border-radius: 1rem;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .jld-card-header {
        position: relative;
        padding: 2rem;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border-bottom: 2px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jld-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #2563eb, #3b82f6);
    }

    .jld-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .jld-title {
        font-size: 1.875rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .jld-subtitle {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: left;
    }

    .jld-status-badge {
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

    .jld-date {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 4rem;
        text-align: right;
    }

    .jld-card-body {
        padding: 2rem;
    }

    .jld-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .jld-section {
        margin-bottom: 2rem;
    }

    .jld-section-title {
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

    .jld-section-title i {
        margin-right: 0.75rem;
    }

    .jld-image-box {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .jld-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .jld-image {
        cursor: pointer;
        width: 150px;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .jld-image:hover {
        transform: scale(1.1);
    }

    .jld-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .jld-info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jld-info-item:last-child {
        border-bottom: none;
    }

    .jld-info-icon {
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

    .jld-info-content {
        flex: 1;
    }

    .jld-info-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .jld-info-value {
        color: #64748b;
    }

    .jld-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .jld-skill-badge {
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 9999px;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .jld-skill-badge:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-1px);
    }

    .jld-description-box {
        margin-top: 1rem;
        position: relative;
        width: 100%;
    }

    .jld-description {
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

    .jld-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .jld-btn {
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

    .jld-btn-primary {
        background: #2563eb;
        color: white;
        border-color: #1d4ed8;
    }

    .jld-btn-primary:hover {
        background: #1d4ed8;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    .jld-btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
    }

    .jld-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-1px);
    }

    .jld-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
        margin-left: 1rem;
    }

    .jld-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .jld-grid {
            grid-template-columns: 1fr;
        }

        .jld-header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .jld-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="jld-container">
    <div class="jld-card">
        <!-- Header -->
        <div class="jld-card-header">
            <div class="jld-header-content">
                <div>
                    <h1 class="jld-title">{{ $post->title }}</h1>
                    <h2 class="jld-subtitle">Nhà tuyển dụng: {{ $post->employer->employer_name }}</h2>
                </div>
                <div>
                    <span class="jld-status-badge 
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
                    <div class="jld-date">Đăng ngày: {{$post->created_at ? date('d/m/Y', strtotime($post->created_at)) : 'Không có' }}</div>
                </div>
            </div>
        </div>
        <!-- Body -->
        <div class="jld-card-body">
            <div class="jld-grid">
                <!-- Main Content -->
                <div class="jld-main-content">
                    <!-- Job Overview -->
                    <div class="jld-section">
                        <div class="jld-section-title">
                            <i class="fas fa-briefcase"></i>
                            Tổng quan
                        </div>
                        <div class="jld-info-box">
                            <div class="jld-info-item">
                                <div class="jld-info-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="jld-info-content">
                                    <div class="jld-info-label">Vị trí</div>
                                    <div class="jld-info-value">{{ $post->position }}</div>
                                </div>
                            </div>
                            <div class="jld-info-item">
                                <div class="jld-info-icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="jld-info-content">
                                    <div class="jld-info-label">Danh mục</div>
                                    <div class="jld-info-value">{{ $post->category->category_name }}</div>
                                </div>
                            </div>
                            <div class="jld-info-item">
                                <div class="jld-info-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="jld-info-content">
                                    <div class="jld-info-label">Khu vực</div>
                                    <div class="jld-info-value">{{ $post->area }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Description -->
                    <div class="jld-section">
                        <div class="jld-section-title">
                            <i class="fas fa-align-left"></i>
                            Mô tả công việc
                        </div>
                        <div class="jld-description-box">
                            <textarea class="jld-description" readonly>
                            {{ $post->description }}
                            </textarea>
                        </div>
                    </div>
                    <!-- Skills -->
                    <div class="jld-section">
                        <div class="jld-section-title">
                            <i class="fas fa-code"></i>
                            Kỹ năng yêu cầu
                        </div>
                        <div class="jld-skills">
                            @foreach($post->skills as $skill)
                            <span class="jld-skill-badge">{{ $skill->skill_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="jld-sidebar">
                    <div class="jld-section">
                        <div class="jld-section-title">
                            <i class="fas fa-info-circle"></i>
                            Thông tin bổ sung
                        </div>
                        <div class="jld-info-box">
                            <div class="jld-info-item">
                                <div class="jld-info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="jld-info-content">
                                    <div class="jld-info-label">Ngày hết hạn bài đăng</div>
                                    <div class="jld-info-value">
                                        {{ $post->expiration_date ? date('d/m/Y', strtotime($post->expiration_date)) : 'Không có' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jld-section">
                        <div class="jld-section-title">
                            <i class="fas fa-image"></i>
                            Hình ảnh
                        </div>
                        <div class="jld-image-box">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                alt="Ảnh đại diện"
                                class="jld-image"
                                id="profileImage"
                                data-bs-toggle="modal"
                                data-bs-target="#imageUpdateModal">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="jld-card-footer">
            <a href="{{ route('post_listed') }}" class="jld-btn jld-btn-secondary">
                Quay lại
            </a>
            <div>
                <a href="{{ route('edit_post', $post->post_id) }}" class="jld-btn jld-btn-primary">
                    Sửa
                </a>
                <a href="{{ route('delete_post', $post->post_id) }}" class="jld-btn jld-btn-danger"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này?')">
                    Xóa
                </a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageUpdateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật ảnh bài viết<table></table></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateImage_post', $post->post_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh mới:</label>
                        <input type="file" name="image" accept="image/*" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
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
            window.location.href = "{{ route('post_listed') }}";
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
@endsection