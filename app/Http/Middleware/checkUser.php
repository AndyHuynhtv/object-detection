<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (session()->has('user')) {
            // $user = $request->session()->get('user');
            // $role = $user->role;

            // Kiểm tra role của người dùng và định tuyến tới trang admin hoặc user
            if ($user->role == 'user') {
                return redirect('/user');
            }
        }
        return redirect()->route('viewLogin');
    }
}
