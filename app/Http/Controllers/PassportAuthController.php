<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Hash the password
        ]);

        $token = $user->createToken('MohammedLaravel')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    // Login a user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('MohammedLaravel')->accessToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    // Get user info
    public function userInfo()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }
}
