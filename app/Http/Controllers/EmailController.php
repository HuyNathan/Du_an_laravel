<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email'
        ]);

        // Lấy email từ request
        $email = $request->input('email');

        // Dispatch job SendMail để gửi email
        SendMail::dispatch($email);
        
        // Ghi log thông tin gửi email
        Log::info('Email job dispatched for: ' . $email);

        return response()->json(['message' => 'Email is being sent!']);
    }
}
