<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function admin(){
        return redirect('dashboard/login');
    }
    public function login(){
        if(Auth::check()){
            return redirect('dashboard/mainpage');
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
            return redirect('dashboard/mainpage');
        }
        return back()->withErrors([
            'loginError'=>'Email atau password salah',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect('dashboard/login');
    }
    public function register(Request $request){
        $previousUrl = $request->input('previous');
        session(['url.intended' => $previousUrl]);
        return view('admin.auth.register');
    }
    public function registration(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        Auth::login($user);
        return redirect()->intended('/')->with('success', 'Pendaftaran berhasil. Anda telah masuk.');
    }
    
}
