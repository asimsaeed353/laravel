<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validate
        $validatedAttributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::default(), 'confirmed']
        ]);

        // create user in database
        $user = User::create($validatedAttributes);

        // log in user
        Auth::login($user);

        // redirect somewhere (dashboard, home page)
        return redirect('/jobs');
    }
}
