@extends('dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .employer-container {
        width: 50%;
        margin: 50px auto;
        background-color: white;
        padding: 20px;
        border: 1px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        display: flex;
        flex-wrap: wrap;
    }

    .employer-form-group {
        margin-bottom: 15px;
        width: 100%;
        margin-top: 20px;
        margin-left: 15px;
    }

    .employer-form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .employer-form-group input,
    .employer-form-group textarea {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
    }

    .employer-form-group textarea {
        height: 120px;
    }

    .employer-form-group button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .employer-form-group select {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
    }

    .employer-form-group button:hover {
        background-color: #45a049;
    }

    @media (max-width: 500px) {
        .employer-container {
            width: 90%;
            flex-direction: column;
            align-items: center;
        }
    }
</style>
<div class="title">CHỈNH SỬA HỒ SƠ</div>
<div class="employer-container">
    <form method="POST" action=" {{ route('update_profile_employer') }}" enctype="multipart/form-data">
        @csrf
        <div class="employer-form-group">
            <label for="employer_name">Tên nhà tuyển dụng</label>
            <input type="text" name="employer_name" value="{{ $employer->employer_name }}">
        </div>
        <div class="employer-form-group">
            <label for="dob">Ngày sinh</label>
            <input type="date" name="dob" value="{{ old('date_of_birth', $employer->date_of_birth 
            ? \Carbon\Carbon::parse($employer->date_of_birth)->format('Y-m-d') : '') }}">
        </div>
        <div class="employer-form-group">
            <label for="age">Tuổi</label>
            <input type="number" name="age" value="{{ $employer->age }}">
        </div>
        <div class="employer-form-group">
            <label for="gender">Giới tính</label>
            <select name="gender" id="gender">
                <option value="Nam" {{ $employer->gender === 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $employer->gender === 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ $employer->gender === 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="employer-form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" value="{{ $employer->address }}">
        </div>

        <div class="employer-form-group">
            <label for="company_name">Tên công ty</label>
            <input type="text" name="company_name" value="{{ $employer->company_name }}">
        </div>
        <div class="employer-form-group">
            <label for="introduction">Giới thiệu</label>
            <textarea name="introduction">{{ $employer->introduce }}</textarea>
        </div>
        <div class="employer-form-group">
            <button type="submit">Cập nhật</button>
        </div>
    </form>
</div>

@if(Session::has('success'))
<script>
    Swal.fire({
        title: "Thành công!",
        text: "{{ Session::get('success') }}",
        icon: "success",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('employer_setting') }}";
        }
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