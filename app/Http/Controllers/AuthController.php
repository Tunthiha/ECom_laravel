<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' =>['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        Auth::login($user);
        return redirect('/')->with('success', 'Welcome ' . $user->name);
    }
    public function showLogin()
    {
        return view('Auth.login');
    }

    public function postLogin(Request $request)
    {

         $request->validate([
            'email' => ['required', 'email','unique:users'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember_me') ? true : false ;
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember)) {

            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);

    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
