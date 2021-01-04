<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contactus;

class ContactUsController extends Controller
{
    


    public function Contactus(Request $request){
        $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min:8']

        ]);

        Mail::to(env('App_email'))->send(new Contactus($request->email, $request->username, $request->message));

        return response()->json('Message Sent Successfully', 200);

    }
}
