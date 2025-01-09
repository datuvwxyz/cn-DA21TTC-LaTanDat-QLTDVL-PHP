<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function showProfileFreelancer()
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $freelancer = Freelancer::where('account_id', $account_id)->first();

        if (!$freelancer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer.');
        }

        $skills = Skill::all();

        return view('pages.users.user_setting', compact('freelancer', 'skills'));
    }

    public function editProfileFreelancer()
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $freelancer = Freelancer::where('account_id', $account_id)->first();

        if (!$freelancer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer.');
        }

        $skills = Skill::all();

        return view('pages.users.edit_user_setting', compact('freelancer', 'skills'));
    }

    public function updateProfileFreelancer(Request $request)
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }
        
        $request->validate([
            'freelancer_name' => 'string|max:255',
            'dob' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:18|max:100',
            'address' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'introduction' => 'nullable|nullable|string|max:1000',
            'gender' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            // 'skills' => 'array', // Đảm bảo có trường skills là mảng
            // 'skill.*' => 'exists:skill,skill_id' // Kiểm tra nếu các skill_id tồn tại trong bảng skills
        ]);

        try {
            $freelancer = Freelancer::where('account_id', $account_id)->first();

            if (!$freelancer) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer.');
            }

            $freelancer->freelancer_name = $request->input('freelancer_name');
            $freelancer->date_of_birth = $request->input('dob');
            $freelancer->age = $request->input('age');
            $freelancer->address = $request->input('address');
            $freelancer->experements = $request->input('experience');
            $freelancer->introduce = $request->input('introduction');
            $freelancer->gender = $request->input('gender');

            $freelancer->save();

            return redirect()->back()->with('success', 'Cập nhật thông tin freelancer thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật không thành công, vui lòng thử lại!');
        }
    }

    public function updateImageProfile(Request $request)
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $freelancer = Freelancer::where('account_id', $account_id)->first();

            if (!$freelancer) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer.');
            }

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('freelancer_images', 'public');
                $freelancer->image = $imagePath;
            }

            $freelancer->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật không thành công, vui lòng thử lại!');
        }
    }
}
