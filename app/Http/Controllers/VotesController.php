<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Server;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Resources\commentCollection;
use App\Models\Replay;
use  \Illuminate\Support\Carbon;
class VotesController extends Controller
{
    public function Vote(Request $request){

        //check recaptcha 
        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json('invalid recaptcha.', 403);
        }

        //get my ip
        $my_Ip = getIPAddress();
       $user_id ="";
       $db_ip = "";
       $withemail = false;
        //validate
           if(auth('sanctum')->check()){
            $request->validate([
                'rating' => ['required'],
                'comment' => ['required', 'min:3'],
                'server_id' => ['required'],
                'iam' => ['required'],
            ]);

            $user_id = auth('sanctum')->id(); //get user id 
            $db_ip = auth('sanctum')->user()->ip;
           } else{
                $request->validate([
                'username' => ['required', 'max:150', 'min:4'],
                'rating' => ['required'],
                'comment' => ['required', 'min:3'],
                'server_id' => ['required'],
                'iam' => ['required'],
            ]);
            if ($request->email != "") {
                $request->validate([
                    'email' => ['email', 'unique:users'],
                ]);
                $withemail = true;
            }
            $user = User::where('ip', $my_Ip)->first();
             
            if($user){
                    if($user->username == $request->username){
                    $user_id =  $user->id;
                    $db_ip = $user->ip;
                    }else{
                       
                        return response()->json('You Can\'t Vote With Multiple Usernames', 403); 
                    }
            }else{
                $user =  User::where('username', $request->username)->first();  
                if($user){
                   
                    return response()->json('The Username Already Taken', 403); 
                }else {
                    //create guest user
                    $email = uniqid() .'_' . 'guest.mt2';
                    if($withemail){
                            $email = $request->email;
                    }
                    $user =  User::create([
                        'username' => $request->username,
                        'email' => $email,
                        'password' => 'guest',
                        'ip' => $my_Ip,
                    ]);
                    $user_id = $user->id;
                    $db_ip = $user->ip;
                }
            }
         }

         //check compare ip 

      if(compare_ip_addresses($db_ip,$my_Ip)){

            //check if alredy voted (validation) =>  3 time in 8h  , 1 time in 24h for each server    

          
            //check if already 3 in 8h

            $date = new \DateTime();
            $date->modify('-8 hours');
            $formatted_date = $date->format('Y-m-d H:i:s');
            $data =  Vote::where('created_at', '>', $formatted_date)->where('ip', $my_Ip)->get();
            if(count($data) <= 2){
                //check if already voted in 24h
                $vote  = Vote::where('ip', $my_Ip)->where('server_id', $request->server_id)->first(); 
                if($vote){
                    $time = $vote->created_at;
                    $now = Carbon::now();
                    $time =   $time->diff($now)->days;
                    if ($time < 1) {
                        return response()->json('You have already voted on this server, you must wait 24 hours to vote again', 403);
                    } 
                } 
             }else{
                //you cant
                return response()->json('You can only vote 3 servers in 8 hours', 403);
            }
          }else{
              //ip is not the same 
            return response()->json('You can\'t Vote ', 403);
             }

    //vote 
        $server =    Server::findOrFail($request->server_id);
        $server->realtimeVote  =  $server->realtimeVote + 1;
        $server->save();
        Vote::create([
            'server_id' => $request->server_id,
            'ip' =>  $my_Ip,
        ]);
        Comment::create([
            'user_id' => $user_id,
            'comment' => $request->comment,
            'iam' => $request->iam,
            'server_id'=>$request->server_id,
            'rate' => $request->rating,
        ]);
        return response()->json('You have voted successfully', 200);

        
       
}

    public function GetComments($slug){
       $server =  Server::where('slug',$slug)->first();
        return   commentCollection::collection(Comment::where('server_id', $server->id)->get()); 
    }


    public function Replay(Request $request){
        //check recaptcha
        if (!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'), $request->ReqResponse)) {
            return response()->json('invalid recaptcha.', 403);
        }

        $user_id = "";
        if(auth('sanctum')->check()){
            $request->validate([
                'comment' => ['required', 'min:3'],
                'comment_id' => ['required']
            ]);
            $user = auth('sanctum')->user();
            Replay::create([
                'username' => $user->username,
                'email' => $user->email,
                'comment' => $request->comment,
                'comment_id' => $request->comment_id
            ]);

          }else{
            $request->validate([
                'username' => ['required', 'max:150', 'min:4'],
                'comment' => ['required', 'min:3'],
                'comment_id' => ['required']
            ]); Replay::create([
                'username' => $request->username,
                'email' => $request->email,
                'comment' => $request->comment,
                'comment_id' => $request->comment_id
            ]);
        }
    
        

        return response()->json('You Replayed successfully', 200);

    }


    
}
