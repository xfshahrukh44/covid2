<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
//        $credentials = request(['email', 'password']);
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'type' => $request->type,
            'passport_number' => $request->passport_number,
            'city' => $request->city,
            'key' => $request->key,
            'last_pcr_result' => $request->last_pcr_result,
            'quarantine_status' => $request->quarantine_status,
        ]);

        return $this->login($request);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update(Arr::except($request->all(), 'id'));
        return $user;
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
