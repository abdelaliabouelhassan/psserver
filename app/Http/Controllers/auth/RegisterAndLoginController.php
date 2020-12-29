<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterAndLoginController extends Controller
{
    // create new account
    public function register(Request $request){

        $request->validate([
            'username'=>['required','max:100','min:2','unique:users'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:8','confirmed']

        ]);


        User::create([
           'username'=>$request->username,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]);


    }
    //login
    public function login(Request $request){
           $request->validate([
            'username'=>['required'],
            'password'=>['required'],
        ]);

        if(Auth::attempt($request->only('username','password'))){
            return response()->json(Auth::user(),200);
        }

        return response()->json('The Provided Cerdentials Are Incorrect.',422);
    }

    //logout
    public function logout(){
        return Auth::logout();
    }
}
