<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Credentials does not match'], 401);
        }

        $user = Auth::user();
        return response()->json(['data' => $token], 200);

    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json(['data' => $token], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['data' => null], 204);
    }

    public function refresh()
    {
        return response()->json(['data' => Auth::refresh()], 200);
    }
}
