<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function admin(){
        return redirect('admin/login');
    }
    public function login(){
        if(Auth::check()){
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('admin/dashboard');
        }
        return back()->withErrors([
            'loginError'=>'Email atau password salah',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
