<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
