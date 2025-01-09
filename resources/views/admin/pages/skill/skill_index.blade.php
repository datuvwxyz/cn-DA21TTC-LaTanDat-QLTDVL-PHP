@extends('admin.dashboard')

@section('content')
<div class="container-fluid'">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">KỸ NĂNG</h6>
        </div>
        @if(Session::has('success'))
        <span class="alert alert-success p-2">{{Session::get('success')}}</span>
        @endif
        <div class="card-header py-1">
            <a href="{{ route('create_skill') }}"><button class="btn btn-outline-primary">Thêm</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Danh mục</th>
                            <th>Tên kỹ năng</th>
                            <th>Yêu cầu kĩ năng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_skill as $i => $skill)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $skill->category->category_name }}</td> 
                            <td>{{ $skill->skill_name }}</td>
                            <td>{{ $skill->field }}</td>
                            <td>
                                <a href="{{ route('edit_skill', ['skill_id' => $skill->skill_id]) }}">
                                    <button type="button" class="btn btn-outline-info">Sửa</button>
                                </a>
                                <a href="{{ route('delete_skill', ['skill_id' => $skill->skill_id]) }}">
                                    <button type="button" class="btn btn-outline-danger">Xóa</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection