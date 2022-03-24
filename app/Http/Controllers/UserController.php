<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $formData=$request->validate([
            'name'=>"required",
            'email'=>'required|email|unique:users',
            'phone_number'=>'required|min:10|numeric',
            'password'=>'required|min:5|max:12']);

        $formData['password']=Hash::make($formData['password']);
        $user=User::create([
            'name'=>$formData['name'],
            'email'=>$formData['email'],
            'password'=>$formData['password'],
            'phone_number'=>$formData['phone_number'],
        ]);
        $token=$user->createToken('user_login')->plainTextToken;
        return response(['user'=>$user,'token'=>$token],201);

    }


    public function login(Request $request)
    {
        $formData=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12']);

        $user=User::where('email',$formData['email'])->first();

        if(!$user || !Hash::check($formData['password'],$user->password))
        {
            abort(403,'password or email mismatched');
        }

        return response(['user'=>$user,'token'=>$user->createToken('user_login')->plainTextToken]);
    }
}
