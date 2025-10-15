<?php

namespace App\Http\Controllers;

use App\Models\MyJobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>['required','min:2'],
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->email);
        return ['user'=> $user,'token'=>$token->plainTextToken];

    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>['required'],
            'password'=>['required']
        ]);
        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password))
        {
            return ['message'=>'Invalid Credentials'];
        }

         $token = $user->createToken($user->email);
        return ['user'=>$user,'token'=> $token->plainTextToken];
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete(); 

        return ['message'=>'logout successful'];
    }
}
