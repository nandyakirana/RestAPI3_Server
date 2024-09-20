<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // public function __construct()env
    // {
    //     $this->middleware('auth:api', ['expect', ['login']]);
    // }
    public function login(Request $request)
    {
        // $credentials = $requ::est->only('username', 'password');
        // return response()->json($credentials);
        // $token = JWTAuth::attempt($credentials);
        // return response()->json($token);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $user = new User();
        $get = $user::where('username', $credentials['username'])->first();
        if($get || Hash::check($credentials['password'], $get->password)){
            session(['logged_in' => true]);
            return redirect()->route('todos.index');
        }
        

        // try {
        //     if (!$token = auth()->guard('api')->attempt($credentials)) {
        //         return response()->json(['error' => 'Invalid Credentials'], 400);
        //     }
        //     return response()->json('berhasil');
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'Could not create token'], 500);
        // }

        // return response()->json(compact('token'));
    }
}
