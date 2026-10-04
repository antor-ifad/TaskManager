<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status_code' => 401,
                'message'     => 'Invalid email or password',
            ], 401);
        }

        // $token = $user->createToken('mobile-app', now()->addDays(7))->plainTextToken;
        $token = $user->createToken(
            'mobile-app',
            ['*'],
            now()->addDays(7)
        )->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message'     => 'Login successful',
            'data'        => [
                'user'  => $user,
                'token' => $token,
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message'     => 'Logged out successfully',
        ]);
    }
}
