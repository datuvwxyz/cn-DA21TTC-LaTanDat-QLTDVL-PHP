@extends('admin.dashboard')

@section('content')
<style>
  .status-badge {
    padding: 3px 5px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
  }

  .activee {
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
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh sách bài đăng</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên bài đăng</th>
            <th>Ngày hết hạn bài đăng</th>
            <th>Nhà tuyển dụng</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @if($postJobs->isEmpty())
          <tr>
            <td colspan="9" class="text-center">Không có bài đăng nào</td>
          </tr>
          @else
          @foreach($postJobs as $i => $post)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->expiration_date ? date('d/m/Y', strtotime($post->expiration_date)) : 'Không có' }}</td>
            <td>{{ $post->employer->employer_name ?? 'N/A' }}</td>
            <td>{{ $post->category->category_name ?? 'N/A' }}</td>
            <td>
              <span class="status-badge 
                @if($post->status == 'Active') activee
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
                <a href="{{ route('admin_post_detail', $post->post_id) }}">
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
@endsection