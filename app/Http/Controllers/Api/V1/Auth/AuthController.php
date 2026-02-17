<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();

        $token = $user->createToken('fsm-api')->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token,
                'user' => $user->load('roles'),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if ($user) {
            $user->currentAccessToken()?->delete();
        }

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function me(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        return response()->json([
            'data' => $user->load('roles'),
        ]);
    }
}

