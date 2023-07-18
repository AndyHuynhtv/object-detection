<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $this -> validate($request, [
            'email' => 'required | email:filter',
            'password' => 'required'
        ]);
        if(['email' => 'admin@gmail.com',
        'password' => '123'
        ])
        {
            return redirect() -> route('main');
        }
        else return redirect() -> back();
    }
    public function viewAddUser()
    {
        return view('admin.main.userAdd');
    }
}
