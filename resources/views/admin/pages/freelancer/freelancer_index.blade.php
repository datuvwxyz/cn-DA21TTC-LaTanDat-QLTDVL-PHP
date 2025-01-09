@extends('admin.dashboard')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh sách freelancer</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($freelancer_accounts as $i => $freelancer)
          <tr>
            <td>{{ $i + 1}}</td>
            <td>{{ $freelancer->user_name}}</td>
            <td>******</td>
            <td>{{ $freelancer->email}}</td>
            <td>{{ $freelancer->tel}}</td>
            <td>{{ $freelancer->role}}</td>
            <td>
              <div>
                <a href="{{ route('admin_detail_freelancer', ['freelancer_id' => $freelancer->freelancer->first()->freelancer_id]) }}">
                  <button type="button" class="btn btn-outline-link">Xem thông tin chi tiết</button>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection