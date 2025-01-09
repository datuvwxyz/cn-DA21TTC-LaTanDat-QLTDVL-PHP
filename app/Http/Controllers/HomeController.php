<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function introduce()
    {
        return view('pages.introduce');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::send('pages.email_contact', $data, function($message) {
            $message->to('your-email@gmail.com')  
                    ->subject('Thông điệp mới từ website freelancer');
        });

        return back()->with('success', 'Email đã được gửi thành công!');
    }
}
