@extends('dashboard');

@section('content')
<style>
    .freelancer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
        margin-top: 100px;
    }

    .freelancer-card {
        background: white;
        border: 2px solid #ccc;
        border-radius: 1rem;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .freelancer-card-header {
        position: relative;
        padding: 2rem;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border-bottom: 2px solid #ccc;
    }

    .freelancer-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #2563eb, #3b82f6);
    }

    .freelancer-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .freelancer-title {
        font-size: 1.875rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .freelancer-subtitle {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: left;
    }

    .freelancer-status-badge {
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

    .freelancer-date {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 4rem;
        text-align: right;
    }

    .freelancer-card-body {
        padding: 2rem;
    }

    .freelancer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .freelancer-section {
        margin-bottom: 2rem;
    }

    .freelancer-section-title {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #ccc;
        color: #2563eb;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .freelancer-section-title i {
        margin-right: 0.75rem;
    }

    .freelancer-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .freelancer-image-box {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .freelancer-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .freelancer-image {
        cursor: pointer;
        width: 150px;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .freelancer-image:hover {
        transform: scale(1.1);
    }

    .freelancer-info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 2px solid #ccc;
    }

    .freelancer-info-item:last-child {
        border-bottom: none;
    }

    .freelancer-info-icon {
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

    .freelancer-info-content {
        flex: 1;
    }

    .freelancer-info-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .freelancer-info-value {
        color: #64748b;
    }

    .freelancer-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .freelancer-skill-badge {
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 9999px;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .freelancer-skill-badge:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-1px);
    }

    .freelancer-description-box {
        margin-top: 1rem;
        position: relative;
        width: 100%;
    }

    .freelancer-description {
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

    .freelancer-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .freelancer-btn {
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

    .freelancer-btn-primary {
        background: #2563eb;
        color: white;
        border-color: #1d4ed8;
    }

    .freelancer-btn-primary:hover {
        background: #1d4ed8;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    .freelancer-btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
    }

    .freelancer-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-1px);
    }

    .freelancer-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
        margin-left: 1rem;
    }

    .freelancer-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .freelancer-grid {
            grid-template-columns: 1fr;
        }

        .freelancer-header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .freelancer-title {
            font-size: 1.5rem;
        }
    }

    .modal-dialog {
        pointer-events: auto;
    }

    body.modal-open {
        overflow: hidden;
        padding-right: 0 !important;
    }
</style>

<div class="freelancer-container">
    <div class="freelancer-card">
        <div class="freelancer-card-header">
            <div class="freelancer-header-content">
                <div>
                    <h1 class="freelancer-title">{{ $freelancer->freelancer_name }}</h1>
                    <h2 class="freelancer-subtitle">Công ty: </h2>
                </div>
                <div>
                    <span class="freelancer-status-badge">{{ $freelancer->status ?? 'Active' }}</span>
                    <div class="freelancer-date">Ngày tạo: {{ $freelancer->created_at ? date('d/m/Y', strtotime($freelancer->created_at)) : 'Không có' }}</div>
                </div>
            </div>
        </div>
        <div class="freelancer-card-body">
            <div class="freelancer-grid">
                <div class="freelancer-main-content">
                    <div class="freelancer-section">
                        <div class="freelancer-section-title">
                            <i class="fas fa-id-card"></i>
                            Thông tin cá nhân
                        </div>
                        <div class="freelancer-info-box">
                            <div class="freelancer-info-item">
                                <div class="freelancer-info-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="freelancer-info-content">
                                    <div class="freelancer-info-label">Ngày sinh</div>
                                    <div class="freelancer-info-value">{{ $freelancer->date_of_birth ? date('d/m/Y', strtotime($freelancer->date_of_birth)) : 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="freelancer-info-item">
                                <div class="freelancer-info-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="freelancer-info-content">
                                    <div class="freelancer-info-label">Tuổi</div>
                                    <div class="freelancer-info-value">{{ $freelancer->age ?? 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="freelancer-info-item">
                                <div class="freelancer-info-icon">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="freelancer-info-content">
                                    <div class="freelancer-info-label">Giới tính</div>
                                    <div class="freelancer-info-value">{{ $freelancer->gender ?? 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="freelancer-info-item">
                                <div class="freelancer-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="freelancer-info-content">
                                    <div class="freelancer-info-label">Địa chỉ</div>
                                    <div class="freelancer-info-value">{{ $freelancer->address ?? 'Không có' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="freelancer-section">
                        <div class="freelancer-section-title">
                            <i class="fas fa-info-circle"></i>
                            Giới thiệu
                        </div>
                        <div class="freelancer-description-box">
                            <textarea class="freelancer-description" readonly>
                            {{ $freelancer->introduce ?? 'Không có' }}
                            </textarea>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="freelancer-sidebar">
                    <div class="freelancer-section">
                        <div class="freelancer-section-title">
                            <i class="fas fa-image"></i>
                            Ảnh đại diện
                        </div>
                        <div class="freelancer-image-box">
                            <img src="{{ $freelancer->image ? asset('storage/' . $freelancer->image) : asset('frontend/img/default-img/default-img.jpg') }}"
                                alt="Ảnh đại diện"
                                class="freelancer-image"
                                id="profileImage"
                                data-bs-toggle="modal"
                                data-bs-target="#imageUpdateModal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="freelancer-card-footer">
            <a href="{{ route('home') }}" class="freelancer-btn freelancer-btn-secondary">
                Quay lại
            </a>
            <div>
                <a href="{{ route('edit_freelancer_setting')}}" class="freelancer-btn freelancer-btn-primary">
                    Sửa
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageUpdateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật ảnh đại diện</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update_image_freelancer') }}" method="POST" enctype="multipart/form-data">
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
@endsection