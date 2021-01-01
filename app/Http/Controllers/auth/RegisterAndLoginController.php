<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterAndLoginController extends Controller
{
    // create new account
    public function register(Request $request){

        $request->validate([
            'username'=>['required','max:100','min:2','unique:users'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:8','confirmed']

        ]);


       $user =  User::create([
           'username'=>$request->username,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]);

        $user =   User::findOrFail($user->id);
        $bytes = random_bytes(20);
        $name    =   bin2hex($bytes) .'_'. uniqid() . '_' .  Carbon::now();
        $token = $name;
        $user->remember_token = $token;
        $user->save();
        Mail::to($request->email)->send(new VerificationEmail($token,$request->email,$request->username));

        return response()->json('Account Created Successfully',200);

    }
    //login
    public function login(Request $request){
           $request->validate([
            'username'=>['required'],
            'password'=>['required'],
            'g_recaptcha_response'=>['required', 'captcha']
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

    


    public function verifyemail($email,$token){
         $user =   User::where('email',$email)->first();
         if($user){
               if($user->remember_token == $token){
                    $user->email_verified_at = now();
                    $user->remember_token = "";
                    $user->save();
                    return redirect('/home');
               }else{
                   return abort(404);
               }
         }else{
             return abort(404);
         }
    }

    public function Verification(){
        $user =   User::findOrFail(auth('sanctum')->id());
        $bytes = random_bytes(20);
        $name    =   bin2hex($bytes) . '_' . uniqid() . '_' .  Carbon::now();
        $token = $name;
        $user->remember_token = $token;
        $user->save();
        Mail::to($user->email)->send(new VerificationEmail($token, $user->email, $user->username));

        return response()->json('Verification email sent successfully', 200);
    }
}
