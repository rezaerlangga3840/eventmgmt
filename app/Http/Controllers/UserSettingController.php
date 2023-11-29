<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class UserSettingController extends Controller
{
    public function usersetting(){
        $user = User::where('id',Auth::id())->first();
        return view('admin.pages.user.setting', ['user' => $user]);
    }
    public function usersettingupdate(Request $req){
        if (!(Hash::check($req->input('currentpassword'), Auth::user()->password))) {
            return redirect()->back()->with('wrongpassword','Password salah!');
        }
        $this->validate($req, [
            'email' => 'required|email|unique:users,email,'.$req->id,
            'currentpassword' => 'required',
        ]);
        $email=$req->input('email');
        $currentpassword=$req->input('currentpassword');
        $newpassword=$req->input('newpassword');
        $user = Auth::user();
        if($newpassword!=null){
            if($newpassword!=$currentpassword){
                $user->email=$email;
                $user->password=bcrypt($newpassword);
            }else{
                return redirect()->back()->with('mustdifferent','Password baru harus berbeda dengan password saat ini!');
            }
        }else{
            $user->email=$email;
        }
        $user->save();
        return redirect()->back()->with('successfullyupdate','User telah diupdate!');
    }
}
