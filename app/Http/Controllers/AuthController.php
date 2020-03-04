<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/');
        }

        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
