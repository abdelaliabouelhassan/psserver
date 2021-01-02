<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Server;
use App\Models\Vote;
use Illuminate\Http\Request;
use  \Illuminate\Support\Carbon;
class VotesController extends Controller
{
    public function Vote(Request $request){
        $request->validate([
            'username' => ['required', 'max:150', 'min:4'],
            'rating' => ['required'],
            'comment' => ['required','min:3'],
            'server_id'=> ['required'], 
            'iam'=> ['required'], 
             ]);
            if($request->email != ""){
            $request->validate([
                'email' => ['email'], 
            ]);

          }


        //check if alredy voted (validation) =>  3 time in 8h  , 1 time in 24h for each server
                //get my ip
            $my_Ip = "";
            //whether ip is from the share internet  
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $my_Ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $my_Ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            //whether ip is from the remote address  
            else {
            $my_Ip = $_SERVER['REMOTE_ADDR'];
            }
           $my_Ip = substr($my_Ip, 0, -1);
           $vote  = Vote::where('ip', $my_Ip)->where('server_id',$request->server_id)->first();
         if($vote){


            //check if already 3 in 8h
            $date = new \DateTime();
            $date->modify('-8 hours');
            $formatted_date = $date->format('Y-m-d H:i:s');
            $data =  Vote::where('created_at', '>', $formatted_date)->where('ip', $my_Ip)->get();
            if (count($data) <= 2) {
                   if ($vote->server_id == $request->server_id) {
                    //check if already voted in 24h
                    $time = $vote->created_at;
                    $now = Carbon::now();
                    $time =   $time->diff($now)->days;
                    if ($time >= 1) {
                        //store
                        $server =    Server::findOrFail($request->server_id);
                        $server->realtimeVote  =  $server->realtimeVote + 1;
                        $server->save();

                        Vote::create([
                            'server_id' => $request->server_id,
                            'ip' =>  $my_Ip,
                        ]);
                        Comment::create([
                            'username' => $request->username,
                            'email' => $request->email,
                            'comment' => $request->comment,
                            'iam' => $request->iam,
                            'rate' => $request->rating,
                        ]);
                        return response()->json('You have voted successfully', 200);
                    } else {
                        return response()->json('You have already voted on this server, you must wait 24 hours to vote again', 403);
                    }
                }else{
                    //store
                    $server =    Server::findOrFail($request->server_id);
                    $server->realtimeVote  =  $server->realtimeVote + 1;
                    $server->save();

                    Vote::create([
                        'server_id' => $request->server_id,
                        'ip' =>  $my_Ip,
                    ]);
                    Comment::create([
                        'username' => $request->username,
                        'email' => $request->email,
                        'comment' => $request->comment,
                        'iam' => $request->iam,
                        'rate' => $request->rating,
                    ]);
                    return response()->json('You have voted successfully', 200);
                } 
               
            } else {
                //you cant
                return response()->json('You can only vote 3 servers in 8 hours', 403);
            }
        }else{
            //store
            $server =    Server::findOrFail($request->server_id);
            $server->realtimeVote  =  $server->realtimeVote + 1;
            $server->save();

            Vote::create([
                'server_id' => $request->server_id,
                'ip' =>  $my_Ip,
            ]);
            Comment::create([
                'username' => $request->username,
                'email' => $request->email,
                'comment' => $request->comment,
                'iam' => $request->iam,
                'rate' => $request->rating,
            ]);


            return response()->json('You have voted successfully',200);
        }

//store comment 


//add vote to server


          return "great";
    }
}
