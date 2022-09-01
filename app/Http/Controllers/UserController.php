<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials)){
            return $credentials;
        }
        return back()->withErrors([
            'email' => '',
            'password' => 'Email or Password is incorrect'
        ]);
    }

    public function logout()
    {
       return Auth::logout();
    }

    public function index()
    {
        return User::orderBy('id', 'desc')->get();
    }
    public function show(User $user)
    {
        return $user;
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $requestData = $request->all();
        if($request->hasFile('image')){
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $requestData['image'] = '/images/'.$fileName;
        }else{
            $requestData['image'] = '/images/profile.png';
        }
        
        return User::create($requestData);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::find($request->id);
        $requestData = $request->all();
        if($request->hasFile('image')){
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $requestData['image'] = '/images/'.$fileName;
        }
        $user->update($requestData);
        return $user;
    }
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
