@extends('admin.dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Sửa kỹ năng</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="{{ route('update_skill', ['skill_id' => $skill->skill_id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="skill_name">Tên kỹ năng</label>
                        <input type="text" class="form-control" name="skill_name" value="{{ old('skill_name', $skill->skill_name) }}">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ $category->category_id == $skill->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="field">Yêu cầu kĩ năng</label>
                        <input type="text" class="form-control" name="field" value="{{ old('field', $skill->field) }}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Cập nhật kỹ năng</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection