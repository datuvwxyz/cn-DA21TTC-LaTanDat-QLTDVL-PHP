@extends('dashboard');

@section('content')
<style>
    .employer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
        margin-top: 100px;
    }

    .employer-card {
        background: white;
        border: 2px solid #ccc;
        border-radius: 1rem;
        box-shadow: 0 5px 8px -1px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .employer-card-header {
        position: relative;
        padding: 2rem;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border-bottom: 2px solid #ccc;
    }

    .employer-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(to right, #2563eb, #3b82f6);
    }

    .employer-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .employer-title {
        font-size: 1.875rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .employer-subtitle {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
        margin-top: 2rem;
        text-align: left;
    }

    .employer-status-badge {
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

    .employer-date {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 4rem;
        text-align: right;
    }

    .employer-card-body {
        padding: 2rem;
    }

    .employer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .employer-section {
        margin-bottom: 2rem;
    }

    .employer-section-title {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #ccc;
        color: #2563eb;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .employer-section-title i {
        margin-right: 0.75rem;
    }

    .employer-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .employer-image-box {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .employer-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .employer-image {
        cursor: pointer;
        width: 150px;
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .employer-image:hover {
        transform: scale(1.1);
    }

    .employer-info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 2px solid #ccc;
    }

    .employer-info-item:last-child {
        border-bottom: none;
    }

    .employer-info-icon {
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

    .employer-info-content {
        flex: 1;
    }

    .employer-info-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .employer-info-value {
        color: #64748b;
    }

    .employer-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .employer-skill-badge {
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 9999px;
        color: #475569;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .employer-skill-badge:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-1px);
    }

    .employer-description-box {
        margin-top: 1rem;
        position: relative;
        width: 100%;
    }

    .employer-description {
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

    .employer-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .employer-btn {
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

    .employer-btn-primary {
        background: #2563eb;
        color: white;
        border-color: #1d4ed8;
    }

    .employer-btn-primary:hover {
        background: #1d4ed8;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    .employer-btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border-color: #cbd5e1;
    }

    .employer-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-1px);
    }

    .employer-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
        margin-left: 1rem;
    }

    .employer-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .employer-grid {
            grid-template-columns: 1fr;
        }

        .employer-header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .employer-title {
            font-size: 1.5rem;
        }
    }

    .custom-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
    }

    .modal-dialog {
        pointer-events: auto;
    }

    body.modal-open {
        overflow: hidden;
        padding-right: 0 !important;
    }
</style>

<div class="employer-container">
    <div class="employer-card">
        <div class="employer-card-header">
            <div class="employer-header-content">
                <div>
                    <h1 class="employer-title">{{ $employer->employer_name }}</h1>
                    <h2 class="employer-subtitle">Công ty: {{ $employer->company_name }}</h2>
                </div>
                <div>
                    <span class="employer-status-badge">{{ $employer->status ?? 'Active' }}</span>
                    <div class="employer-date">Ngày tạo: {{ $employer->created_at ? date('d/m/Y', strtotime($employer->created_at)) : 'Không có' }}</div>
                </div>
            </div>
        </div>
        <div class="employer-card-body">
            <div class="employer-grid">
                <div class="employer-main-content">
                    <div class="employer-section">
                        <div class="employer-section-title">
                            <i class="fas fa-id-card"></i>
                            Thông tin cá nhân
                        </div>
                        <div class="employer-info-box">
                            <div class="employer-info-item">
                                <div class="employer-info-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="employer-info-content">
                                    <div class="employer-info-label">Ngày sinh</div>
                                    <div class="employer-info-value">{{ $employer->date_of_birth ? date('d/m/Y', strtotime($employer->date_of_birth)) : 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="employer-info-item">
                                <div class="employer-info-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="employer-info-content">
                                    <div class="employer-info-label">Tuổi</div>
                                    <div class="employer-info-value">{{ $employer->age ?? 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="employer-info-item">
                                <div class="employer-info-icon">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="employer-info-content">
                                    <div class="employer-info-label">Giới tính</div>
                                    <div class="employer-info-value">{{ $employer->gender ?? 'Không có' }}</div>
                                </div>
                            </div>
                            <div class="employer-info-item">
                                <div class="employer-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="employer-info-content">
                                    <div class="employer-info-label">Địa chỉ</div>
                                    <div class="employer-info-value">{{ $employer->address ?? 'Không có' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="employer-section">
                        <div class="employer-section-title">
                            <i class="fas fa-info-circle"></i>
                            Giới thiệu
                        </div>
                        <div class="employer-description-box">
                            <textarea class="employer-description" readonly>
                            {{ $employer->introduce ?? 'Không có' }}
                            </textarea>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="employer-sidebar">
                    <div class="employer-section">
                        <div class="employer-section-title">
                            <i class="fas fa-image"></i>
                            Ảnh đại diện
                        </div>
                        <div class="employer-image-box">
                            <img src="{{ $employer->image 
                                ? asset('storage/' . $employer->image) 
                                : asset('frontend/img/default-img/default-img.jpg') }}"
                                alt="Ảnh đại diện"
                                class="employer-image"
                                id="profileImage"
                                data-bs-toggle="modal"
                                data-bs-target="#imageUpdateModal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="employer-card-footer">
            <a href="{{ route('home') }}" class="employer-btn employer-btn-secondary">
                Quay lại
            </a>
            <div>
                <a href="{{ route('edit_employer_setting')}}" class="employer-btn employer-btn-primary">
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
                <form action="{{ route('update_image_employer') }}" method="POST" enctype="multipart/form-data">
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