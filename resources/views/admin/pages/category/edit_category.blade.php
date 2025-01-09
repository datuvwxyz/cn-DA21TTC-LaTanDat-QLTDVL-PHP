@extends('admin.dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Sửa danh mục</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="{{ route('update_category', ['category_id' => $category->category_id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>ID danh mục</label>
                        <input type="text" class="form-control" name="category_id" value="{{ $category->category_id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control" name="description" value="{{ $category->description }}">
                    </div>
                    <button type="submit" class="btn btn-outline-info">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection