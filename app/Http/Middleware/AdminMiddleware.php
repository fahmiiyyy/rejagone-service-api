<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'admin') {

            return response()->json([
                'message' => 'Access denied'
            ], 403);
        }

        return $next($request);
    }
}