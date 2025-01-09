@extends('dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .post-job-title {
        text-align: center;
        color: #34495e;
        font-size: 2em;
        margin-bottom: 30px;
        font-weight: 700;
        position: relative;
        z-index: 1;
        margin-top: 150px;
    }

    .post-job-container {
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

    .post-job-form-group {
        margin-bottom: 15px;
        width: 100%;
        margin-top: 20px;
        margin-left: 15px;
    }

    .post-job-form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .post-job-form-group input,
    .post-job-form-group textarea {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
    }

    .post-job-form-group textarea {
        height: 120px;
    }

    .post-job-form-group button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .post-job-form-group button:hover {
        background-color: #45a049;
    }

    .post-job-form-group select {
        width: 700px;
        max-width: 700px;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #000;
        border-radius: 5px;
        box-sizing: border-box;
        margin: 10px auto;
        background-color: #fff;
    }

    .post-job-form-group select:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(0, 128, 0, 0.5);
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
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
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
        .post-job-container {
            width: 90%;
            flex-direction: column;
            align-items: center;
        }

        .post-job-form-group input,
        .post-job-form-group textarea {
            width: 100%;
            max-width: 100%;
        }
    }
</style>
<div class="post-job-title">SỬA TIN TUYỂN DỤNG</div>
<div class="post-job-container">
    <form method="POST" action="{{ route('update_post', $post->post_id)}}">
        @csrf
        <div class="post-job-form-group">
            <label for="title">Tên tin tuyển dụng</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div class="post-job-form-group">
            <label for="position">Vị trí tuyển dụng</label>
            <input type="text" name="position" value="{{ old('position', $post->position) }}">
        </div>
        <div class="post-job-form-group">
            <label for="area">Khu vực</label>
            <select name="area" id="area" required>
                <option value="" disabled selected>Chọn khu vực</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= htmlspecialchars($province) ?>"
                        <?= old('area', $post->area) == $province ? 'selected' : '' ?>>
                        <?= htmlspecialchars($province) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="post-job-form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" placeholder="Mô tả ...">{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="post-job-form-group">
            <label for="category">Danh mục công việc</label>
            <select name="category_id" id="category" required>
                <option value="" disabled>Chọn danh mục</option>
                @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                    {{ $post->category_id == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="post-job-form-group">
            <label for="skills">Kỹ năng</label>
            <select name="skills[]" id="skills">
                @foreach($categories as $category)
                @foreach($category->skills as $skill)
                <option value="{{ $skill->skill_id }}"
                    data-category-id="{{ $category->category_id }}"
                    {{ in_array($skill->skill_id, $post->skills->pluck('skill_id')->toArray()) ? 'selected' : '' }}>
                    {{ $skill->skill_name }}
                </option>
                @endforeach
                @endforeach
            </select>
            <div id="skills-tags" class="skills-container">
                @foreach($post->skills as $skill)
                <div class="skill-tag" data-skill-id="{{ $skill->skill_id }}">
                    {{ $skill->skill_name }}
                    <span class="edit-skill" onclick="editSkill(this, '{{ $skill->skill_id }}')">
                    </span>
                    <span class="remove-skill" onclick="removeSkill(this, '{{ $skill->skill_id }}')">×</span>
                    <input type="hidden" name="skills[]" value="{{ $skill->skill_id }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="post-job-form-group">
            <label for="expiration_date">Ngày hết hạn</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date', $post->expiration_date 
            ? \Carbon\Carbon::parse($post->expiration_date)->format('Y-m-d') : '') }}">
        </div>

        <div class="post-job-form-group">
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
            window.location.href = "{{ route('post_detail', $post->post_id) }}";
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
        const categorySelect = document.getElementById('category');
        const skillsSelect = document.getElementById('skills');
        const skillsTagsContainer = document.getElementById('skills-tags');

        function addSkillsPlaceholder() {
            let placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.text = 'Vui lòng chọn danh mục trước';
            placeholder.selected = true;
            placeholder.disabled = true;
            skillsSelect.insertBefore(placeholder, skillsSelect.firstChild);
        }

        function hideAllSkills() {
            Array.from(skillsSelect.options).forEach(option => {
                if (option.value !== '') {
                    option.style.display = 'none';
                }
            });
            skillsSelect.value = '';
        }

        function showSkillsForCategory(categoryId) {
            Array.from(skillsSelect.options).forEach(option => {
                if (option.value === '') return;
                option.style.display = option.dataset.categoryId === categoryId ? '' : 'none';
            });
        }

        function isSkillAlreadyAdded(skillId) {
            return Array.from(document.querySelectorAll('.skill-tag'))
                .some(tag => tag.dataset.skillId == skillId);
        }

        function createSkillTag(skillId, skillName) {
            const skillTag = document.createElement('div');
            skillTag.classList.add('skill-tag');
            skillTag.dataset.skillId = skillId;
            skillTag.innerHTML = `
            ${skillName}
                <span class="edit-skill" onclick="editSkill(this, ${skillId})"></span>
                <span class="remove-skill" onclick="removeSkill(this, ${skillId})">×</span>
            <input type="hidden" name="skills[]" value="${skillId}">
        `;

            skillTag.style.opacity = '0';
            skillsTagsContainer.appendChild(skillTag);
            requestAnimationFrame(() => {
                skillTag.style.opacity = '1';
                skillTag.style.transition = 'opacity 0.3s ease-in-out';
            });

            return skillTag;
        }

        if (typeof initialSkills !== 'undefined' && initialSkills.length) {
            Array.from(document.querySelectorAll('.skill-tag')).forEach(tag => {
                const skillId = tag.dataset.skillId;
                tag.innerHTML = `
            ${tag.textContent.trim()}
                <span class="edit-skill" onclick="editSkill(this, ${skillId})"></span>
                <span class="remove-skill" onclick="removeSkill(this, ${skillId})">×</span>
            <input type="hidden" name="skills[]" value="${skillId}">
        `;
            });
        }

        categorySelect.addEventListener('change', function() {
            const selectedCategoryId = this.value;
            if (!selectedCategoryId) {
                skillsSelect.disabled = true;
                hideAllSkills();
            } else {
                skillsSelect.disabled = false;
                showSkillsForCategory(selectedCategoryId);
            }
        });

        skillsSelect.addEventListener('change', function() {
            const selectedSkill = this.value;
            if (!selectedSkill) return;

            const selectedOption = this.querySelector(`option[value="${selectedSkill}"]`);
            const skillName = selectedOption?.text;

            if (skillName && !isSkillAlreadyAdded(selectedSkill)) {
                createSkillTag(selectedSkill, skillName);
            }
            this.value = '';
        });

        window.editSkill = function(element, skillId) {
            const tag = element.closest('.skill-tag');
            const categoryId = document.querySelector(`option[value="${skillId}"]`).dataset.categoryId;

            categorySelect.value = categoryId;
            categorySelect.dispatchEvent(new Event('change'));

            skillsSelect.value = skillId;
            tag.remove();
        };

        window.removeSkill = function(element, skillId) {
            const tag = element.closest('.skill-tag');
            tag.style.opacity = '0';
            tag.style.transform = 'scale(0.8)';
            tag.style.transition = 'all 0.3s ease-in-out';

            setTimeout(() => {
                tag.remove();
            }, 300);
        };

        addSkillsPlaceholder();
        skillsSelect.disabled = true;
        hideAllSkills();

        if (categorySelect.value) {
            categorySelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection