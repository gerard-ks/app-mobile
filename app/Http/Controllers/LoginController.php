<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        //dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        //en cas d'echec
        return to_route('login')->withErrors([
           'email' => "Email invalide",
            'password' => "Mot de passe invalide"
        ])->onlyInput('email', 'password');
    }

    public function logout() {
        Auth::logout();
        return to_route('login');
    }
}
