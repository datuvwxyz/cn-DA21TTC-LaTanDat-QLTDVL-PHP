<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function showProfileEmployer()
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $employer = Employer::where('account_id', $account_id)->first();

        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        return view('pages.employers.employer_setting', compact('employer'));
    }

    public function editProfileEmployer()
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $employer = Employer::where('account_id', $account_id)->first();

        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
        }

        return view('pages.employers.edit_employer_setting', compact('employer'));
    }

    public function updateProfileEmployer(Request $request)
    {
        $account_id = session('user_id');

        if (!$account_id) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }
        $request->validate([
            'employer_name' => 'string|max:255',
            'dob' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:18|max:100',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'introduction' => 'nullable|string|max:1000',
            'gender' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $employer = Employer::where('account_id', $account_id)->first();

            if (!$employer) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
            }

            $employer->employer_name = $request->input('employer_name');
            $employer->date_of_birth = $request->input('dob');
            $employer->age = $request->input('age');
            $employer->address = $request->input('address');
            $employer->company_name = $request->input('company_name');
            $employer->introduce = $request->input('introduction');

            $employer->save();

            return redirect()->back()->with('success', 'Cập nhật thông tin nhà tuyển dụng thành công!');
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
            $employer = Employer::where('account_id', $account_id)->first();

            if (!$employer) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng.');
            }

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('employer_images', 'public');
                $employer->image = $imagePath;
            }

            $employer->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật không thành công, vui lòng thử lại!');
        }
    }
}
