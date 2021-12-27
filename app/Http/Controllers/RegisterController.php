<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {

        $request = request()->validate([
            'username' => 'required|min:3|max:255|unique:users,username',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'password' => 'required|min:6|max:255'
        ]);
        User::create($request);
        return redirect('/blog/')->with('success', 'User Account Created');
    }
}
