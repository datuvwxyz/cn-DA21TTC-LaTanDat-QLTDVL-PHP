<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $all_skill = Skill::all();
        $categories = Category::with('skills')->get();
        return view('admin.pages.skill.skill_index', compact('all_skill', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.skill.create_skill', compact('categories'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|max:255',
            'field' => 'nullable|max:500',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,category_id',
        ]);

        try {
            $skill = new Skill();
            $skill->skill_name = $request->input('skill_name');
            $skill->field = $request->input('field');

            $categoryId = $request->input('categories')[0];
            $skill->category_id = $categoryId;

            $skill->save();

            return redirect()->route('skill_index')->with('success', 'Thêm kỹ năng thành công');
        } catch (\Exception $e) {
            return redirect()->route('create_skill')->with('fail', $e->getMessage());
        }
    }

    public function edit($skill_id)
    {
        $skill = Skill::find($skill_id);

        if (!$skill) {
            return redirect()->route('skill_index')->with('fail', 'Kỹ năng không tồn tại');
        }

        $categories = Category::all();

        return view('admin.pages.skill.edit_skill', compact('skill', 'categories'));
    }

    public function update(Request $request, $skill_id)
    {
        $request->validate([
            'skill_name' => 'required|max:255',
            'field' => 'nullable|max:500',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        try {
            $skill = Skill::find($skill_id);

            if (!$skill) {
                return redirect()->route('skill_index')->with('fail', 'Kỹ năng không tồn tại');
            }

            $skill->skill_name = $request->input('skill_name');
            $skill->field = $request->input('field');

            $categoryId = $request->input('category_id');

            if ($categoryId) {
                $skill->category_id = $categoryId;
            } else {
                return redirect()->route('edit_skill', $skill_id)->with('fail', 'Danh mục không hợp lệ');
            }

            $skill->update();

            return redirect()->route('skill_index')->with('success', 'Cập nhật kỹ năng thành công');
        } catch (\Exception $e) {
            return redirect()->route('edit_skill', $skill_id)->with('fail', $e->getMessage());
        }
    }
    public function delete($skill_id)
    {
        $skill = Skill::find($skill_id);

        if (!$skill) {
            return redirect()->route('skill_index')->with('fail', 'Kỹ năng không tồn tại');
        }

        $skill->delete();

        return redirect()->route('skill_index')->with('success', 'Xóa kỹ năng thành công');
    }
}
