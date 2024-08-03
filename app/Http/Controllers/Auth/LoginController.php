<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        $sliders = \App\Models\slider::query()->latest('id')->where('status', '=', 1)->get();

        return view('auth.login',compact('sliders'));
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($credentials);

        // attempt:  Hàm kiểm tra đăng nhập (Truy xuất cơ sở dữ liệu)
        if (Auth::attempt($credentials)) {

            $userLogin = User::query()->where('email', '=', $credentials['email'])->first();

            // dd($userLogin);

            if($userLogin->type == 'admin'){
                // dd($userLogin);
                // $userLogin->session()->regenerate();
                return redirect()->intended('/admin');
            }else if($userLogin->type == 'member'){
                // $userLogin->session()->regenerate();
                return redirect()->intended('/');
            }

            // $userLogin->session('admin')->regenerate();
            
            // return redirect()->intended('/');
        }

        // Lỗi log ra ngoài
        // onlyInput : giữ lại giá trị trường Email
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        \request()->session()->invalidate();

        return redirect('/');
    }
}
