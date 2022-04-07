<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
//    old functions moved to AdminController

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni' => 'nullable|unique:users',
            'rut' => 'nullable|unique:users',
            'city' => 'sometimes',
            'unique_key' => 'sometimes',
            'passport_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mother_name' => 'required',
            'origin_country' => 'required',
            'commune_visit' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::create([
            'dni' => $request['dni'],
            'unique_key' => $request['unique_key'],
            'passport_number' => $request['passport_number'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'mother_name' => $request['mother_name'],
            'origin_country' => $request['origin_country'],
            'commune_visit' => $request['commune_visit'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => 'user',
        ]);

        return response()->json($user);
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

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|email',
            'dni' => 'sometimes',
            'rut' => 'sometimes',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        if($request->has('email')){
            $credentials = [
                "email" => $request->email,
                "password" => $request->password
            ];
        }
        if($request->has('dni')){
            $credentials = [
                "dni" => $request->dni,
                "password" => $request->password
            ];
        }
        if($request->has('rut')){
            $credentials = [
                "rut" => $request->rut,
                "password" => $request->password
            ];
        }

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $user = User::find(auth()->user()->id)->toArray();
        $ms = Carbon::now()->addSeconds(86400)->timestamp;
        $res = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'expiry' => Carbon::now()->addSeconds(86400)
        ];
//        dd($res);

        return response()->json(array_merge($user, $res));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'sometimes|min:4',
            'dni' => 'nullable|unique:users,dni,' . auth()->user()->id,
            'rut' => 'nullable|unique:users,rut,' . auth()->user()->id,
            'city' => 'sometimes',
            'unique_key' => 'sometimes',
            'passport_number' => 'sometimes',
            'mother_name' => 'sometimes',
            'origin_country' => 'sometimes',
            'commune_visit' => 'sometimes',
        ]);

        if(!$user = User::find(auth()->user()->id)) {
            return api_not_found();
        }

        $req = $request->all();
        if($request->has('password')){
            $req['password'] = Hash::make($request['password']);
        }

        $user->update($req);

        return response()->json($user);
    }
}
