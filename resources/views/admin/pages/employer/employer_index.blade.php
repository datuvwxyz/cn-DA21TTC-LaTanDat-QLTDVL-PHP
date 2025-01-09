@extends('admin.dashboard')

@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh sách nhà tuyển dụng</h6>
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
          @foreach ($employer_accounts as $i => $employer)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $employer->user_name}}</td>
            <td>******</td>
            <td>{{ $employer->email}}</td>
            <td>{{ $employer->tel}}</td>
            <td>{{ $employer->role}}</td>
            <td>
              <div>
                <a href="{{ route('admin_detail_employer', ['employer_id' => $employer->employer->first()->employer_id]) }}">
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