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

    .freelancer-container {
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

    .freelancer-form-group {
        margin-bottom: 15px;
        width: 100%;
        margin-top: 20px;
        margin-left: 15px;
    }

    .freelancer-form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .freelancer-form-group input,
    .freelancer-form-group textarea {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
    }

    .freelancer-form-group textarea {
        height: 120px;
    }

    .freelancer-form-group button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .freelancer-form-group button:hover {
        background-color: #45a049;
    }

    .freelancer-form-group select {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
    }

    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .skill-tag {
        background-color: rgb(139, 154, 140);
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .skill-tag span {
        margin-left: 5px;
        cursor: pointer;
    }

    .skill-tag span:hover {
        font-weight: bold;
        color: #fff;
    }

    @media (max-width: 500px) {
        .freelancer-container {
            width: 90%;
            flex-direction: column;
            align-items: center;
        }
    }
</style>
<div class="title">CHỈNH SỬA HỒ SƠ</div>
<div class="freelancer-container">
    <form method="POST" action=" {{ route('update_profile_freelancer') }}" enctype="multipart/form-data">
        @csrf
        <div class="freelancer-form-group">
            <label for="freelancer_name">Tên freelancer</label>
            <input type="text" name="freelancer_name" value="{{ $freelancer->freelancer_name }}">
        </div>
        <div class="freelancer-form-group">
            <label for="dob">Ngày sinh</label>
            <input type="date" name="dob" value="{{ old('date_of_birth', $freelancer->date_of_birth 
            ? \Carbon\Carbon::parse($freelancer->date_of_birth)->format('Y-m-d') : '') }}">
        </div>
        <div class="freelancer-form-group">
            <label for="age">Tuổi</label>
            <input type="number" name="age" value="{{ $freelancer->age }}">
        </div>
        <div class="freelancer-form-group">
            <label for="gender">Giới tính</label>
            <select name="gender" id="gender">
                <option value="Nam" {{ $freelancer->gender === 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $freelancer->gender === 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ $freelancer->gender === 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="freelancer-form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" value="{{ $freelancer->address }}">
        </div>
        <div class="freelancer-form-group">
            <label for="experience">Kinh nghiệm</label>
            <input type="text" name="experience" value="{{ $freelancer->experements }}">
        </div>
        <div class="freelancer-form-group">
            <label for="skills">Kỹ năng</label>
            <select id="skills" name="skills[]">
                <option disabled selected>Chọn kỹ năng</option>
                @foreach($skills as $skill)
                <option value="{{ $skill->skill_id }}"
                    {{ in_array($skill->skill_id, $freelancer->skills->pluck('skill_id')->toArray()) ? 'selected' : '' }}>
                    {{ $skill->skill_name }}
                </option>
                @endforeach
            </select>
            <div id="skills-tags" class="skills-container"></div>
        </div>
        <div class="freelancer-form-group">
            <label for="introduction">Giới thiệu</label>
            <textarea id="introduction" name="introduction">{{ $freelancer->introduce }}</textarea>
        </div>
        <div class="freelancer-form-group">
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
            window.location.href = "{{ route('freelancer_setting') }}";
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const skillsSelect = document.getElementById('skills');
        const skillsTagsContainer = document.getElementById('skills-tags');

        skillsSelect.addEventListener('change', function() {
            const selectedSkills = Array.from(skillsSelect.selectedOptions).map(option => option.value);

            selectedSkills.forEach(skillId => {
                const skillName = skillsSelect.querySelector(`option[value="${skillId}"]`).text;

                if (!isSkillAlreadyAdded(skillId)) {
                    const skillTag = document.createElement('div');
                    skillTag.classList.add('skill-tag');
                    skillTag.innerHTML = `${skillName} <span onclick="removeSkill(this, ${skillId})">x</span>`;
                    skillsTagsContainer.appendChild(skillTag);
                }
            });
        });
    });

    function isSkillAlreadyAdded(skillId) {
        const existingTags = document.querySelectorAll('.skill-tag');
        return Array.from(existingTags).some(tag => tag.dataset.skillId == skillId);
    }

    function removeSkill(tag, skillId) {
        tag.parentElement.remove();

        const selectElement = document.getElementById('skills');
        Array.from(selectElement.options).forEach(option => {
            if (option.value == skillId) {
                option.selected = false;
            }
        });
    }
</script>

@endsection