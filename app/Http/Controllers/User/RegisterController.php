<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.register', [
            'title' => 'Đăng Ký Khách Hàng'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Tạo khách hàng mới
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = $request->input('password'); // Không mã hóa
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->save();

        // Đăng nhập và chuyển hướng
        Session::put('customer_id', $customer->id);
        Session::put('customer_name', $customer->name);

        return redirect()->to('/user/login')->with('success', 'Đăng ký thành công!');
    }
}
