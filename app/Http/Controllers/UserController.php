<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // create new user 
    public function register(Request $request)
    {

        // validate fields 
        $request->validate([
            "name" => "required:string",
            "email" => "required|email",
            "password" => "required|confirmed|min:6"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $userCreateToken = "userToken";
        $token = $user->createToken($userCreateToken)->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token
        ], 201);
    }

    // login an existing user 
    public function login(Request $request){

    }


    // logout authenticate user 
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response(["message"=>"You have been logged out!"]);
    }
}
