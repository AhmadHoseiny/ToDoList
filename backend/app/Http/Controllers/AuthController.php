<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:1|max:20'
        ]);

        $user = User::where([
            ['email', '=', $request->email], 
        ])->first();

        if($user && Hash::check($request->password, $user->password)){
            return $user->id;
        }
        else{
            return response()->json(['message' =>
             'Invalid Credentials. Please Try again.'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password)
        ]);
        
    }
}
