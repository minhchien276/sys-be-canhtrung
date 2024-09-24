<?php
namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user && $user->maPhanQuyen == $role) {   
            return $next($request);
        }

        return response()->json([
            'message' => 'Không có quyền truy cập',
            'status' => false
        ], 403);
    }
}
