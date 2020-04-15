<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Traits\RegisterUser;

class RegistrationController extends Controller
{
    use RegisterUser;

    public function show()
    {
        return view('register');
    }

    public function register(RegistrationRequest $requestFields)
    {
        $this->registerUser($requestFields);

        return redirect('/login');
    }
}
