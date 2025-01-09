<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Employer;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {

        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:5',
        ]);

        try {
            $loginData = $request->only('email', 'password');

            $user = Account::where('email', $loginData['email'])->first();

            if ($user && Hash::check($loginData['password'], $user->password)) {
                session([
                    'user_id' => $user->account_id, // Lưu id người dùng 
                    'user_role' => $user->role,  // Lưu vai trò
                    'user_name' => $user->user_name,  // Lưu tên người dùng
                ]);
                if ($user->role === 'admin') {
                    return redirect()->back()->with('success', 'Chào mừng Admin!');
                } elseif ($user->role === 'freelancer') {
                    return redirect()->back()->with('success', 'Chào mừng Freelancer!');
                } elseif ($user->role === 'employer') {
                    return redirect()->back()->with('success', 'Chào mừng Employer!');
                } else {
                    return redirect()->back()->with('error', 'Vai trò không hợp lệ!');
                }
            } else {
                return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đăng nhập không thành công, vui lòng thử lại!');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:6|max:60',
            'email' => 'required|email|max:255',
            'tel' => 'required|regex:/^[0-9]{10,15}$/',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:freelancer,employer',
        ]);

        try {
            $account = new Account();
            $account->user_name = $request->input('user_name');
            $account->email = $request->input('email');
            $account->tel = $request->input('tel');
            $account->password = bcrypt($request->input('password'));
            $account->role = $request->input('role');

            $account->save();

            if ($account->role == 'employer') {
                $employer = new Employer();
                $employer->account_id = $account->account_id;
                $employer->employer_name = $request->input('user_name');
                $employer->date_of_birth = null;
                $employer->age = null;
                $employer->address = null;
                $employer->company_name = null;
                $employer->introduce = null;
                $employer->image = null;

                $employer->save();
            }

            if ($account->role == 'freelancer') {
                $freelancer = new Freelancer();
                $freelancer->account_id = $account->account_id;
                $freelancer->freelancer_name = $request->input('user_name');
                $freelancer->date_of_birth = null;
                $freelancer->age = null;
                $freelancer->address = null;
                $freelancer->experements = null;
                $freelancer->introduce = null;
                $freelancer->image = null;

                $freelancer->save();
            }

            return redirect()->back()->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đăng ký không thành công, vui lòng thử lại');
        }
    }

    public function logout(Request $request)
    {
        try {
            // Xóa toàn bộ session
            $request->session()->flush();

            // Nếu sử dụng cookie để lưu token hoặc thông tin liên quan, xóa cookie:
            $request->session()->invalidate();

            return redirect()->route('dashboard')->with('success', 'Bạn đã đăng xuất thành công!');
        } catch (\Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đăng xuất, vui lòng thử lại!');
        }
    }
}
