<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



class RegisterAndLoginController extends Controller
{


    // create new account
    public function register(Request $request)
    {

        $request->validate([
            'username' => ['required', 'max:100', 'min:2', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed']

        ]);

        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json(trans('message.invalid_recaptcha'), 403);
        }

        $my_Ip =  getIPAddress();


        $user =  User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ip' => $my_Ip,
        ]);

        $user =   User::findOrFail($user->id);
        $bytes = random_bytes(20);
        $name    =   bin2hex($bytes) . '_' . uniqid() . '_' .  Carbon::now();
        $token = $name;
        $user->remember_token = $token;
        $user->save();
        Mail::to($request->email)->send(new VerificationEmail($token, $request->email, $request->username));

        return response()->json('Account Created Successfully', 200);
    }
    //login
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json(trans('message.invalid_recaptcha'), 403);
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            return response()->json(Auth::user(), 200);
        }

        return response()->json(trans('message.Cerdentials'), 403);
    }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required'],
        ]);

        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json(trans('message.invalid_recaptcha'), 403);
        }
        $user =    User::where('email', $request->email)->first();
        if ($user) {

            $code = mt_rand(1000, 9999);
            $user->remember_token = $code;
            $user->save();
            Mail::to($request->email)->send(new ForgotPassword($code));
        } else {
            return response()->json(trans('message.Cerdentials'), 403);
        }
    }



    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => ['required'],
        ]);
        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json(trans('message.invalid_recaptcha'), 403);
        }
        $user =    User::where('email', $request->email)->first();
        if ($user) {
            if ($user->remember_token == $request->code) {
                return response()->json('Go Next', 200);
            } else {
                return response()->json('The Code Incorrect', 403);
            }
        } else {
            return response()->json('Something Went Wrong...', 403);
        }
    }

    public function changeforgotPassword(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);
        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json(trans('message.invalid_recaptcha'), 403);
        }
         $user =    User::where('email', $request->email)->first();
        if ($user) {

            $user->password =  Hash::make($request->password);
            $user->remember_token = "";
            $user->save();
            return response()->json('Password Updated Successfully', 200);
        } else {
            return response()->json('Something Went Wrong...', 403);
        }
    }


    //logout
    public function logout()
    {
        return Auth::logout();
    }




    public function verifyemail($email, $token)
    {
        $user =   User::where('email', $email)->first();
        if ($user) {
            if ($user->remember_token == $token) {
                $user->email_verified_at = now();
                $user->remember_token = "";
                $user->save();
                return redirect('/home');
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function Verification()
    {
        $user =   User::findOrFail(auth('sanctum')->id());
        $bytes = random_bytes(20);
        $name    =   bin2hex($bytes) . '_' . uniqid() . '_' .  Carbon::now();
        $token = $name;
        $user->remember_token = $token;
        $user->save();
        Mail::to($user->email)->send(new VerificationEmail($token, $user->email, $user->username));

        return response()->json('Verification email sent successfully', 200);
    }


    public function changepassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']

        ]);

        if (!Hash::check($request->old_password, auth('sanctum')->user()->password)) {
            return response()->json(trans('message.match'), 403);
        } else {
            User::findOrFail(auth('sanctum')->user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json('Password Updated Successfully', 200);
        }
    }
}
