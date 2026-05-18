<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 401);
            }

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }

        return $next($request);
    }
}