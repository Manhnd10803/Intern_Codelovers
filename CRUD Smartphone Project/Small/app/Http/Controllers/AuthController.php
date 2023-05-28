<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;


use App\Task;
use App\Jobs\SendEmail;
use App\Mail\ForgotPass;

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
    public function submitFormForgotPass(Request $request){
        $request->validate([
            'email' => 'required|exists:users'
        ],[
            'email.required' => 'Bạn chưa nhập email',
            'email.exists' => 'Email không tồn tại'
        ]);
        $email = $request->email;
        $token = strtoupper(Str::random(10));
        User::where('email', $email)->update([
            'remember_token' => $token
        ]);
        $user = User::where('email', $email)->first();
        $data = [ 
            'name' => $user->name,
            'id' => $user->id,
            'remember_token' => $user->remember_token
            ];
        Mail::to($email)->send(new ForgotPass($data));
        toastr()->success('Truy cập Gmail để đổi mật khẩu', 'Gửi mail thành công');
        return redirect('/');
    }
    public function getFormNewPass($id, $token){
        $user = User::where('id', $id)->first();
        if($user->remember_token == $token){
            $pageTitle = 'New Password';
            return view('account.newPass', compact('pageTitle', 'id'));
        }
        toastr()->error('Liên kết đã hết hạn');
        return redirect('/');
    }
    public function submitFormNewPass(Request $request){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ],
        [
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không trùng'
        ]);
        User::where('id', $request->id)->update([
            'password' => bcrypt($request->password)
        ]);
        toastr()->success('Vui lòng đăng nhập', 'Thay đổi mật khẩu thành công');
        return redirect()->route('login');
    }
    public function testMail(){
        $name = 'test name for email';
        $message = 'abc';
        $users = ['email' => 'shaolingirl180@gmail.com',
        'email' => 'manhdeptrai1082003@gmail.com',   
        ];
        SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));
        return redirect()->back();
    }
}
