<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login', [
            'title' => 'Đăng Nhập Khách Hàng'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Tìm khách hàng trong bảng customers
        $customer = Customer::where('email', $request->input('email'))->first();

        // Kiểm tra nếu khách hàng tồn tại và mật khẩu khớp
        if ($customer && $customer->password === $request->input('password')) {
            // Lưu thông tin đăng nhập vào session
            Session::put('customer_id', $customer->id);
            Session::put('customer_name', $customer->name);

            // Chuyển hướng về trang chủ sau khi đăng nhập thành công
            return redirect()->to('/'); // Hoặc bạn có thể chuyển hướng đến trang mà bạn muốn
        }

        // Nếu đăng nhập thất bại
        Session::flash('error', 'Email hoặc Password không đúng!');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        // Xóa thông tin khách hàng khỏi session
        $request->session()->forget(['customer_id', 'customer_name']);
        
        // Đăng xuất
        Auth::logout();

        return redirect()->route('home'); // Chuyển hướng về trang chủ hoặc trang đăng nhập
    }
}
