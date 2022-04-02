<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

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
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|unique:users',
            'password' => 'required|min:4',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'type' => 'admin',
            'passport_number' => $request->passport_number,
            'city' => $request->city,
            'key' => $request->key,
            'last_pcr_result' => $request->last_pcr_result,
            'quarantine_status' => $request->quarantine_status,
        ]);

        return $this->login($request);
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

    public function index()
    {
        $users = User::where('type', 'admin')->paginate(10);

        $response = [
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem()
            ],
            'data' => $users
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'required|confirmed|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'admin';

        $user = User::create($req);
//        return $user;
        return response()->json($user);
    }

    public function show($id)
    {
        if(!$user = User::find($id)) {
            return api_not_found();
        }

        if($user->type != 'admin') {
            return api_not_found();
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'sometimes|confirmed|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'admin';

        if(!$user = User::find($id)) {
            return api_not_found();
        }

        $user->update($req);
        return response()->json($user);
    }

    public function destroy($id)
    {
        if($id == auth()->user()->id){
            return api_not_allowed();
        }

        if(!$user = User::find($id)) {
            return api_not_found();
        }

        if($user->type != 'admin') {
            return api_not_found();
        }

        return response()->json($user->delete());
    }

    public function user_index(Request $request)
    {
        $users = User::where('type', 'user')->paginate(10);

        $response = [
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem()
            ],
            'data' => $users
        ];

        return response()->json($response);
    }

    public function user_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'required|confirmed|min:4',
            'dni' => 'sometimes',
            'unique_key' => 'sometimes',
            'passport_number' => 'required',
            'mother_name' => 'required',
            'origin_country' => 'required',
            'commune_visit' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'user';

        $user = User::create($req);
//        return $user;
        return response()->json($user);
    }

    public function user_show(Request $request, $id)
    {
        if(!$user = User::find($id)) {
            return api_not_found();
        }

        if($user->type != 'user') {
            return api_not_found();
        }

        return response()->json($user);
    }

    public function user_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'required|confirmed|min:4',
            'dni' => 'sometimes',
            'unique_key' => 'sometimes',
            'passport_number' => 'required',
            'mother_name' => 'required',
            'origin_country' => 'required',
            'commune_visit' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'user';

        $user = User::find($id);
        $user->update($req);
        return response()->json($user);
    }

    public function user_destroy($id)
    {
        if(!$user = User::find($id)) {
            return api_not_found();
        }

        if($user->type != 'user') {
            return api_not_found();
        }

        return response()->json($user->delete());
    }
}
