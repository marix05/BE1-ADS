<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string'],
                'c_password' => ['required', 'same:password'],
            ]);

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if ($user->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'accessToken' => $user->createToken("Personal Access Token")->plainTextToken,
                    'data' => $user,
                ], 201);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'accessToken' => $user->createToken("Personal Access Token")->plainTextToken,
                'token_type' => 'Bearer',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }
}
