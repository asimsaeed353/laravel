<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        // validate
        $validatedAttributes = request()->validate([
           'email' => ['required', 'email'],
           'password' => ['required'],
        ]);

        // attempt to login user

        # if user entered wrong password:
        if(! Auth::attempt($validatedAttributes)){
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match'
            ]);
        }

        # the attempt method returns a boolean if the user has successfully logged in or not

        // regenerate the session token
        request()->session()->regenerate();

        // redirect to some page
        return redirect('/jobs');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }
}
