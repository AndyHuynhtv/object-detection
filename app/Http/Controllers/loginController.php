<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Session;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;

//use App\Http\Controllers\Controller;


class loginController extends Controller
{
    public function viewLogin()
    {   
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role;
        // Kiểm tra role của người dùng và chuyển hướng tới trang admin hoặc user
        if ($role == 'admin' ) {
            return redirect('/admin');
        } elseif ($role == 'user') {
            return redirect('/user');
        }
    } else {
        // Nếu chưa đăng nhập, hiển thị trang đăng nhập
        return view('login.login');
    }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('viewLogin');
    }
  
    public function loginUser(Request $request)
    {   
        $loginInfo = [
            'name' => $request->input('userName'),
            'password' => $request->input('userPassword'),
        ];
        if(Auth::attempt($loginInfo))
        { 
            $user = Auth::user();
            $request->session()->put('user-name', $user->name);
            $request->session()->put('user-role', $user->role);
            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'user') {
                return redirect('/user');
            }
        }
        else {
            return redirect()->route('viewLogin')->with('error', 'Login Unsuccess');
        }
    }
}

