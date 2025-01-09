<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng tới trang login
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        // Nếu đã đăng nhập, tiếp tục yêu cầu
        return $next($request);
    }
}

