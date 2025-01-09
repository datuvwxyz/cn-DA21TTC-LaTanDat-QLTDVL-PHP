@extends('admin.dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Thêm kỹ năng</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="{{ route('add_skill') }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên kỹ năng</label>
                        <input type="text" class="form-control" name="skill_name" value="{{old('skill_name')}}" required>
                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="categories[]" id="categories">
                            @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Yêu cầu kĩ năng</label>
                        <input type="text" class="form-control" name="field" value="{{old('field')}}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Thêm kỹ năng</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection