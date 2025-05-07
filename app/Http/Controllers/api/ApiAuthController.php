<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    function register(Request $request) {
        $data = $request->validate([
            "name"=>"required|string",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|min:8|string",
            "confirm_password"=>"required|same:password",
        ]);

        $user = User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "password"=>Hash::make($data["password"]),
            "balance"=>5000
        ]);
        $token = $user->createToken("token-store")->plainTextToken;


        return response()->json(["data"=>[
            "success"=>true,
            "token"=>$token
        ]]);

    }

    function login(Request $request) {
        $data = $request->validate([
            "email"=>"required|exists:users,email",
            "password"=>"required"
        ]);

        if(Auth::attempt(["email"=>$data["email"],"password"=>$data["password"]])) {
            
            $user = Auth::user();
            $token = $user->createToken("token-store")->plainTextToken;
            return response()->json(["data"=>[
                "success"=>true,
                "token"=>$token
            ]]);

        }


        return response()->json(["data"=>[
            "success"=>false,
            "error"=>"Incorrect password"
        ]]);

    }


    function logout() {
        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json(["data"=>[
            "success"=>true,
            "message"=>"Logout successfuly"
        ]]); 

    }
}
