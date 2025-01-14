@extends('dashboard')

@section('content')
<style>
    .jmd-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
        margin-top: 100px;
    }

    .jmd-card {
        background: white;
        border: 2px solid #ccc;
        border-radius: 1rem;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .jmd-card-header {
        position: relative;
        padding: 2rem;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border-bottom: 2px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jmd-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #2563eb, #3b82f6);
    }

    .jmd-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .jmd-title {
        font-size: 1.875rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .jmd-subtitle {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: left;
    }

    .jmd-status-badge {
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

    .jmd-date {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 4rem;
        text-align: right;
    }

    .jmd-card-body {
        padding: 2rem;
    }

    .jmd-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .jmd-section {
        margin-bottom: 2rem;
    }

    .jmd-section-title {
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

    .jmd-section-title i {
        margin-right: 0.75rem;
    }

    .jmd-image-box {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .jmd-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .jmd-image {
        cursor: pointer;
        width: 150px;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .jmd-image:hover {
        transform: scale(1.1);
    }

    .jmd-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .jmd-info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
        border-bottom: 2px solid #ccc;
    }

    .jmd-info-item:last-child {
        border-bottom: none;
    }

    .jmd-info-icon {
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

    .jmd-info-content {
        flex: 1;
    }

    .jmd-info-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .jmd-info-value {
        color: #64748b;
    }

    .jmd-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .jmd-skill-badge {
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 9999px;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .jmd-skill-badge:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-1px);
    }

    .jmd-description-box {
        margin-top: 1rem;
        position: relative;
        width: 100%;
    }

    .jmd-description {
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

    .jmd-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .jmd-btn {
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

    .jmd-btn-primary {
        background: #2563eb;
        color: white;
        border-color: #1d4ed8;
    }

    .jmd-btn-primary:hover {
        background: #1d4ed8;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    .jmd-btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
    }

    .jmd-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-1px);
    }

    .jmd-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
        margin-left: 1rem;
    }

    .jmd-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .jmd-grid {
            grid-template-columns: 1fr;
        }

        .jmd-header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .jmd-title {
            font-size: 1.5rem;
        }
    }

    .jmd-application-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 20px;
        padding: 15px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .jmd-application-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .jmd-applicant-name {
        font-size: 0.9em;
        color: #666;
    }

    .jmd-application-date {
        color: #666;
        font-size: 0.9em;
    }

    .cv-preview-container {
        width: 100%;
        height: 500px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .cv-preview {
        width: 100%;
        height: 100%;
        border: none;
    }

    .cv-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .cv-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9em;
        transition: background-color 0.2s;
    }

    .cv-download-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
        color: white;
    }

    .jmd-section-title {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #007bff;
        color: #333;
    }

    .jmd-section-title i {
        margin-right: 8px;
        color: #007bff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .cv-preview-container {
            height: 300px;
        }

        .jmd-application-header {
            flex-direction: column;
            gap: 5px;
            align-items: flex-start;
        }
    }
</style>

<div class="jmd-container">
    <div class="jmd-card">
        <!-- Header -->
        <div class="jmd-card-header">
            <div class="jmd-header-content">
                <div>
                    <h1 class="jmd-title">{{ $post->title }}</h1>
                    <h2 class="jmd-subtitle">Nhà tuyển dụng: {{ $post->employer->employer_name }}</h2>
                </div>
                <div>
                    <span class="jmd-status-badge 
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
                    <div class="jmd-date">Đăng ngày: {{$post->created_at ? date('d/m/Y', strtotime($post->created_at)) : 'Không có' }}</div>
                </div>
            </div>
        </div>
        <!-- Body -->
        <div class="jmd-card-body">
            <div class="jmd-grid">
                <!-- Main Content -->
                <div class="jmd-main-content">
                    <!-- Job Overview -->
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-briefcase"></i>
                            Tổng quan
                        </div>
                        <div class="jmd-info-box">
                            <div class="jmd-info-item">
                                <div class="jmd-info-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="jmd-info-content">
                                    <div class="jmd-info-label">Vị trí</div>
                                    <div class="jmd-info-value">{{ $post->position }}</div>
                                </div>
                            </div>
                            <div class="jmd-info-item">
                                <div class="jmd-info-icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="jmd-info-content">
                                    <div class="jmd-info-label">Danh mục</div>
                                    <div class="jmd-info-value">{{ $post->category->category_name }}</div>
                                </div>
                            </div>
                            <div class="jmd-info-item">
                                <div class="jmd-info-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="jmd-info-content">
                                    <div class="jmd-info-label">Khu vực</div>
                                    <div class="jmd-info-value">{{ $post->area }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Description -->
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-align-left"></i>
                            Mô tả công việc
                        </div>
                        <div class="jmd-description-box">
                            <textarea class="jmd-description" readonly>
                            {{ $post->description }}
                            </textarea>
                        </div>
                    </div>
                    <!-- Skills -->
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-code"></i>
                            Kỹ năng yêu cầu
                        </div>
                        <div class="jmd-skills">
                            @foreach($post->skills as $skill)
                            <span class="jmd-skill-badge">{{ $skill->skill_name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-file-alt"></i>
                            Đơn ứng tuyển
                        </div>
                        <div class="jmd-applications">
                            @foreach($post->freelancers as $freelancer)
                            <div class="jmd-application-item">
                                <div class="jmd-application-header">
                                    <span class="jmd-applicant-name">Người ứng tuyển: {{ $freelancer->freelancer_name }}</span>
                                    <span class="jmd-application-date">Ngày nộp CV: {{ $freelancer->pivot->applied_at ? date('d/m/Y', strtotime($freelancer->pivot->applied_at)) : 'Không có' }}</span>
                                </div>
                                <div class="jmd-application-cv">
                                    @if($freelancer->pivot->cv_file)
                                    @php
                                    $cvPath = $freelancer->pivot->cv_file;
                                    // Sử dụng url() helper thay vì asset()
                                    $cvUrl = url('storage/' . $cvPath);
                                    @endphp
                                    <div class="cv-preview-container">
                                        <embed
                                            src="{{ $cvUrl }}"
                                            type="application/pdf"
                                            class="cv-preview"
                                            width="100%"
                                            height="500px">
                                    </div>
                                    <div class="cv-actions">
                                        <a href="{{ $cvUrl }}" download class="cv-download-btn">
                                            <i class="fas fa-download"></i> Tải xuống CV
                                        </a>
                                    </div>
                                    @else
                                    <p>Chưa có CV</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="jmd-sidebar">
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-info-circle"></i>
                            Thông tin bổ sung
                        </div>
                        <div class="jmd-info-box">
                            <div class="jmd-info-item">
                                <div class="jmd-info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="jmd-info-content">
                                    <div class="jmd-info-label">Ngày hết hạn bài đăng</div>
                                    <div class="jmd-info-value">
                                        {{ $post->expiration_date ? date('d/m/Y', strtotime($post->expiration_date)) : 'Không có' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jmd-section">
                        <div class="jmd-section-title">
                            <i class="fas fa-image"></i>
                            Hình ảnh
                        </div>
                        <div class="jmd-image-box">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                alt="Ảnh đại diện"
                                class="jmd-image"
                                id="profileImage"
                                data-bs-toggle="modal"
                                data-bs-target="#imageUpdateModal">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="jmd-card-footer">
            <a href="{{ route('jobs_submited') }}" class="jmd-btn jmd-btn-secondary">
                Quay lại
            </a>
            <!-- <div>
                <a href="{{ route('edit_post', $post->post_id) }}" class="jmd-btn jmd-btn-primary">
                    Sửa
                </a>
                <a href="{{ route('delete_post', $post->post_id) }}" class="jmd-btn jmd-btn-danger"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này?')">
                    Xóa
                </a>
                </form>
            </div> -->
        </div>
    </div>
</div>
@endsection