<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // Kiểm tra xem người dùng đã đăng nhập chưa
    if ($user->role !== 'admin' && $user->role !== 'user') 
    {
        return redirect('/');
    }
        return $next($request);
    }
}
