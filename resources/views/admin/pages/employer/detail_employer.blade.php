@extends('admin.dashboard')

@section('content')
<style>
    .employer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
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

    .employer-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
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

    .employer-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
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

    .employer-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
    }

    .employer-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }
</style>

<div class="employer-container">
    <div class="employer-card">
        <!-- Header -->
        <div class="employer-card-header">
            <div class="employer-header-content">
                <div>
                    <h1 class="employer-title">{{ $employer->employer_name }}</h1>
                    <h2 class="employer-subtitle">Công ty: {{ $employer->company_name ?? 'Không có' }}</h2>
                </div>
                <div class="employer-date">Ngày tạo: {{ $employer->created_at->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Body -->
        <div class="employer-card-body">
            <div class="employer-info-box">
                <div class="employer-info-item">
                    <div class="employer-info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="employer-info-content">
                        <div class="employer-info-label">Ngày sinh</div>
                        <div class="employer-info-value">{{ $employer->date_of_birth ? $employer->date_of_birth->format('d/m/Y') : 'Không có' }}</div>
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
                <div class="employer-info-item">
                    <div class="employer-info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="employer-info-content">
                        <div class="employer-info-label">Tuổi</div>
                        <div class="employer-info-value">{{ $employer->age ?? 'Không có' }}</div>
                    </div>
                </div>
                <div class="employer-info-item">
                    <div class="employer-info-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="employer-info-content">
                        <div class="employer-info-label">Giới thiệu</div>
                        <div class="employer-info-value">{{ $employer->introduce ?? 'Không có' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="employer-card-footer">
            <a href="{{ route('admin_employer_index') }}" class="employer-btn employer-btn-primary">Quay lại</a>
            <a href="" class="employer-btn employer-btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà tuyển dụng này?')">Xóa</a>
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