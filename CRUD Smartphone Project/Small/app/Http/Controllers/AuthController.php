<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function getFormLogin(){
        $pageTitle = 'Login';
        return view('account.login', compact('pageTitle'));
    }
    public function submitFormLogin(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ]);
        if(Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ])){
            $user = User::where('name', $request->name)->first();
            Auth::login($user);
            toastr()->success('Đăng nhập thành công');
            return redirect()->route('product.index');
        }else{
            toastr()->error('Đăng nhập thất bại');
            return redirect()->back();
        }
    }
    public function getFormRegister(){
        $pageTitle = 'Register';
        return view('account.register', compact('pageTitle'));
    }
    public function submitFormRegister(Request $request){
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Tài khoản đã tồn tại',
            'email.required' => 'Bạn chưa nhập Email',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không trùng'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 0;
        $user->save();
        if($user instanceof Model){
            toastr()->success('Đăng ký thành công');
            return redirect()->route('sign-in');
        }
        return redirect()->back();
    }
    public function submitLogout(){
        Auth::logout();
        return redirect()->back();
    }
    public function getFormForgotPass(){
        $pageTitle = 'Forgot Password';
        return view('account.forgotPass', compact('pageTitle'));
    }
    public function testMail(){
        $name = 'test name for email';
        Mail::send('email.test', compact('name'), function($email){
            $email->to('shaolingirl180@gmail.com', 'Nguyễn Đức Mạnh');
        });
    }
}
