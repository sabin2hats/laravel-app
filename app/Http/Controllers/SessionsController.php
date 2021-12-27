<?php

namespace App\Http\Controllers;

use \Illuminate\Validation\ValidationException;
// use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }
    public function store()
    {
        $request = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt($request)) {
            session()->regenerate();
            return redirect('/blog')->with('Success', 'Welcome Back');
        }
        throw ValidationException::withMessages([
            'email' => 'Your Provided Crediantials could not be verified.'
        ]);
    }
    public function destroy()
    {
        auth()->logout();
        return redirect('/blog')->with('success', 'Good Bye');
    }
}
