<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'tenant') {
            return $next($request);
        }

        return redirect('/auth/login')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
