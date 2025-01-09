<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $all_category = Category::all();
        return view('admin.pages.category.category_index', compact('all_category'));
    }

    public function create()
    {
        return view('admin.pages.category.create_category');
    }

    public function add(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        try {
            $category = new Category();
            $category->category_name = $request->input('category_name');;
            $category->description = $request->input('description', ''); 

            $category->save();
            return redirect()->route('category_index')->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->route('create_category')->with('fail', $e->getMessage());
        }
    }

    public function edit($category_id)
    {
        // tìm theo id
        $category = Category::find($category_id);
        return view('admin.pages.category.edit_category', compact('category'));
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        $category = Category::find($category_id);
        $category->category_name = $request->input('category_name');
        $category->description = $request->input('description', '');

        $category->update();
        return redirect()->route('category_index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function delete($category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return redirect()->route('category_index')->with('fail', 'Danh mục không tồn tại');
        }

        $skillsCount = $category->skills()->count();

        if ($skillsCount > 0) {
            return redirect()->route('category_index')->with('fail', 'Không thể xóa danh mục vì có kỹ năng liên quan');
        }

        try {
            $category->delete();
            return redirect()->route('category_index')->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->route('category_index')->with('fail', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
