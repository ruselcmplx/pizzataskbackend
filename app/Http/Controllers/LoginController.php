<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $requestFields)
    {
        $attributes = $requestFields->only(['phone', 'password']);

        $phone = $requestFields->get('phone');

        if (\App\User::where('phone', $phone)->exists()) {
            if (Auth::attempt($attributes)) {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->withErrors(['phone' => "User don't exists"]);
        }

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }
}
