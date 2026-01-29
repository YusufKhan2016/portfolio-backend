<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $request->username) -> first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            $message = 'Invalid Credentials';
            return response() -> json([
                'message' => $message
            ], 401);
        };

        $token = $user->createToken('portfolio-token')->plainTextToken;

        return response()->json([
            'token'  => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request) {
        
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }

}
