<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            'password' => 'required|min:6'
        ]);

        \App\User::create($validator);

        return redirect('/login');
    }
}
