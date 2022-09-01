<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        return User::create($request->only('name','email','password','confirm_password'));
    }
}
