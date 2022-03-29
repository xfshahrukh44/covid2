<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//    old functions moved to AdminController
    public function index(Request $request) {
        return response()->json(User::where('type', 'user')->get());
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'dni' => 'sometimes',
            'unique_key' => 'sometimes',
            'passport_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mother_name' => 'required',
            'origin_country' => 'required',
            'commune_visit' => 'required',
            'email' => 'sometimes|email',
            'password' => 'required',
        ]);

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

    public function login(Request $request){
        $input = $request->all();

        $this->validate($request, [
            'email' => 'sometimes|email',
//            'dni' => 'sometimes',
            'unique_key' => 'sometimes',
            'password' => 'required'
        ]);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $credentials2 = [
            "unique_key" => $request->unique_key,
            "password" => $request->password
        ];

        if (!($token = auth()->attempt($credentials) || $token = auth()->attempt($credentials2)) || (auth()->user()->type != 'user')) {
            auth()->logout();
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

    public function update_any(Request $request) {
        if(!$user = User::find(auth()->user()->id))
        {
            return response()->json(['error' => 'Not found']);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    public function show(Request $request, $id) {
        if(!$user = User::find($id))
        {
            return response()->json(['error' => 'Not found']);
        }

        return response()->json($user);
    }
}
