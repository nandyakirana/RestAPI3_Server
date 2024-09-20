<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        // dd($request->session()->all());
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
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
        // $request->validate([
        //     'username' => 'required|string',
        //     'password' => 'required|string',
        // ]);


        // $username = $request->username;
        // $password = $request->password;
        // if ($request->username === 'admin' && $request->password === '215314211') 
        // {
        //         session(['logged_in' => true]);
        //         return redirect()->route('todos.index');
        // } 

        // return back()->withErrors([
        //     'login_error' => 'Username atau password salah.',
        // ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Auth::logout();

        // Hapus semua session
        $request->session()->flush();

        // Regenerasi session untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau halaman lain
        // dd($request->session()->all());
        return redirect('/login');
    }
}
