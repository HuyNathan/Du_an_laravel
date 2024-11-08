<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Dd;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',[
            'title'=> 'Đăng Nhập Hệ Thống'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=> 'required|email:filter',
            'password'=> 'required'
        ]);    
        
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {
            return redirect()->route('admin.statistics'); // Điều hướng sau khi đăng nhập thành công
        }
        

        Session::flash('error', 'Email hoac Password khong dung !');
        return redirect()->back();
    }
}
