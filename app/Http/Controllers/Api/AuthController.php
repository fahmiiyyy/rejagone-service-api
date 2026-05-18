<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // REGISTER CUSTOMER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'customer'
        ]);

        return response()->json([
            'message' => 'Register success',
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 201);
    }

    // LOGIN JWT
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where(
            'email',
            $validated['email']
        )->first();

        if (
            !$user ||
            !Hash::check(
                $validated['password'],
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = JWTAuth::claims([
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role
        ])->fromUser($user);

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'role' => $user->role,
        ]);
    }
}