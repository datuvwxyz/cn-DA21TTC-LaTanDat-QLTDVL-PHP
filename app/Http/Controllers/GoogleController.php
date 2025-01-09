<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = Account::where('email', $googleUser->email)->first();

            if ($user) {
                if ($user->method === 'google') {
                    Auth::login($user);
                    return redirect('/dashboard')->with('success', 'Đăng nhập thành công!');
                } else {
                    return redirect('/login')->withErrors(['email' => 'Email này đã được sử dụng bởi phương thức khác.']);
                }
            } else {
                $newUser = Account::create([
                    'tai_khoan' => $googleUser->name,
                    'email' => $googleUser->email,
                    'hinh_anh' => $googleUser->avatar,
                    'method' => 'google',
                    'mat_khau' => '',
                    'quyen' => 'freelancer',
                ]);

                Auth::login($newUser);
                return redirect('/dashboard')->with('success', 'Tạo tài khoản và đăng nhập thành công!');
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Có lỗi xảy ra khi đăng nhập.']);
        }
    }
}
