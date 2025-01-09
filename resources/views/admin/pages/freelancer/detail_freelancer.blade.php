@extends('admin.dashboard')

@section('content')
<style>
    .freelancer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
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

    .freelancer-info-box {
        background: #f8fafc;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
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

    .freelancer-card-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
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

    .freelancer-btn-danger {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
    }

    .freelancer-btn-danger:hover {
        background: #dc2626;
        border-color: #9b1c1c;
        transform: translateY(-1px);
    }
</style>

<div class="freelancer-container">
    <div class="freelancer-card">
        <!-- Header -->
        <div class="freelancer-card-header">
            <div class="freelancer-header-content">
                <div>
                    <h1 class="freelancer-title">{{ $freelancer->freelancer_name }}</h1>
                    <h2 class="freelancer-subtitle">Kinh nghiệm: {{ $freelancer->experements ?? 'Không có' }}</h2>
                </div>
                <div class="freelancer-date">Ngày tạo: {{ $freelancer->created_at->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Body -->
        <div class="freelancer-card-body">
            <div class="freelancer-info-box">
                <div class="freelancer-info-item">
                    <div class="freelancer-info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="freelancer-info-content">
                        <div class="freelancer-info-label">Ngày sinh</div>
                        <div class="freelancer-info-value">{{ $freelancer->date_of_birth ? $freelancer->date_of_birth->format('d/m/Y') : 'Không có' }}</div>
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
                <div class="freelancer-info-item">
                    <div class="freelancer-info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="freelancer-info-content">
                        <div class="freelancer-info-label">Tuổi</div>
                        <div class="freelancer-info-value">{{ $freelancer->age ?? 'Không có' }}</div>
                    </div>
                </div>
                <div class="freelancer-info-item">
                    <div class="freelancer-info-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="freelancer-info-content">
                        <div class="freelancer-info-label">Giới thiệu</div>
                        <div class="freelancer-info-value">{{ $freelancer->introduce ?? 'Không có' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="freelancer-card-footer">
            <a href="{{ route('admin_freelancer_index') }}" class="freelancer-btn freelancer-btn-primary">Quay lại</a>
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