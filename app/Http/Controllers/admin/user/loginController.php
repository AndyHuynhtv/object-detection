<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view ('admin.user.login', [
            'login' => 'Login'
        ]);
    } 

    public function main()
    {
        return view('admin.main.index');
    }
    
    public function checkValidate(Request $request) 
    {
        $userName = $request->input('userName');
        $userPassword = $request->input('password');

        if(Auth::attempt(['name'=>$userName, 'password'=>$userPassword])){
            return redirect() -> route('main');
        }
        else return redirect() -> back();
    }
    public function viewAddUser()
    {
        return view('admin.main.userAdd');
    }
}
