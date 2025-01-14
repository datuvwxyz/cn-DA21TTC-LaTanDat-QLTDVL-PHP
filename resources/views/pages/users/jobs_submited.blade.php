@extends('dashboard')

@section('content')

<style>
    .title {
        text-align: center;
        color: #34495e;
        font-size: 2em;
        margin-bottom: 30px;
        font-weight: 700;
        position: relative;
        z-index: 1;
        margin-top: 150px;
    }

    .table {
        border: 2px solid #ccc;
        border-radius: 8px;
    }

    .table th,
    .table td {
        border: 1px solid #ccc;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: bold;
        text-transform: uppercase;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    /* Huy hiệu kỹ năng */
    .badge {
        padding: 5px 10px;
        font-size: 12px;
        margin-right: 5px;
        border-radius: 12px;
    }

    .status-badge {
        padding: 3px 5px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }

    .active {
        background-color: rgb(75, 203, 120);
    }

    .rejected {
        background-color: rgb(192, 78, 78);
    }

    .pending {
        background-color: rgb(150, 150, 150);
    }

    .in-progress {
        background-color: #007bff;
    }
</style>
<div class="card shadow mb-4">
    <div class="card-header py-3" style="align-items: center;">
        <div class="title">Danh sách tin đã ứng tuyển</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên bài đăng</th>
                        <th>Ngày hết hạn bài đăng</th>
                        <th>Nhà tuyển dụng</th>
                        <th>Danh mục</th>
                        <th>Kỹ năng yêu cầu</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if($appliedJobs->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Không có bài đăng nào</td>
                    </tr>
                    @else
                    @foreach($appliedJobs as $i => $post)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->expiration_date ? date('d/m/Y', strtotime($post->expiration_date)) : 'Không có' }}</td>
                        <td>{{ $post->employer->employer_name ?? 'N/A' }}</td>
                        <td>{{ $post->category->category_name ?? 'N/A' }}</td>
                        <td>
                            @foreach($post->skills as $skill)
                            <span class="badge bg-dark">{{ $skill->skill_name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <span class="status-badge 
                                @if($post->status == 'Active') active
                                @elseif($post->status == 'Rejected') rejected
                                @elseif($post->status == 'Pending') pending
                                @elseif($post->status == 'InProgress') in-progress
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
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('jobs_submited_detail' , $post->post_id) }}">
                                    <button type="button" class="btn btn-outline-primary">Xem chi tiết</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div>
    {{ $appliedJobs->links() }}
</div>
@endsection