<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function login(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);


        $user = User::where("email", $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $userCreateToken = "userToken";
            $token = $user->createToken($userCreateToken)->plainTextToken;

            return response([
                "user" => $user,
                "token" => $token
            ], 201);
        }

        return response(["message" => "Invalid username or password!"],401);
    }


    // logout authenticate user 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => "You have been logged out!"]);
    }
}
