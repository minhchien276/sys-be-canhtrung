<?php
namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->session()->has('user') && in_array($request->session()->get('role'), $roles)) {
            
            return $next($request);
        }

        return redirect()->route('error-403')->with('error', 'Bạn không có quyền truy cập vào mục này.');
    }
}