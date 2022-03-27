<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::paginate(10);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'required|confirmed|min:4',
        ]);

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'admin';

        $user = User::create($req);
//        return $user;
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
//        return User::find($id);
        return response()->json(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'password' => 'sometimes|confirmed|min:4',
        ]);

        $req = $request->all();

        if($request->has('password')){
            $req['password'] = Hash::make($request->password);
        }
        $req['type'] = 'admin';

        $user = User::find($id)->update($req);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if($id == auth()->user()->id){
            return response()->json(['success' => false, 'message' => 'Not allowed']);
        }
//        return User::find($id)->destroy();
        return response()->json(User::find($id)->delete());
    }
}
