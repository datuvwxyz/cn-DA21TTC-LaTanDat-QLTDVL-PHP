@extends('admin.dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Thêm danh mục</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="{{ route('add_category') }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" name="category_name" value="{{old('category_name')}}">
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="text" class="form-control" name="description" value="{{old('description')}}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Thêm danh mục</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection