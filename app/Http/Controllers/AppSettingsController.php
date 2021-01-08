<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \Illuminate\Support\Facades\App;
use App\Models\AppSettings;
use App\Models\Server;
use App\Models\Comment;
use App\Http\Resources\ServersCollection;
use App\Http\Resources\commentCollection;
use App\Models\User;


class AppSettingsController extends Controller
{
    public function changLang(Request $request)
    {
        session(['lang' => $request->lang]);
        App::setLocale($request->lang);
        return response()->json($request->lang, 200);
    }

    public function getLang()
    {
        return session()->get('lang');
    }


    public function GetBanners(){
     return   AppSettings::first();
    }

    public function GetfeathredServer()
    {
        
       $app =    AppSettings::first();
       if($app){
            $servers = Server::where('id',$app->server_id)->get();
            return  ServersCollection::collection($servers);
       }else{
           return null;
       }
    }

    public function getUrl(){

        $app =    AppSettings::first();
        if($app){
        return $app->youtube_url;
        }else{
            return null;
        }
        
    }

    public function GetfeathredServerComment(){
        $app =    AppSettings::first();
        if ($app) {
            $comment  = Comment::where('server_id', $app->server_id)->get();
            return  commentCollection::collection($comment);
        } else {
            return null;
        }
    }



    public function deleteComment($id){
      return  Comment::findOrFail($id)->delete();
   
    }
    public function banUser($id){
        $user  =  User::findOrFail($id);
        $user->is_banned = true;
        $user->save();
        return response()->json('user banned',200);
    }
    public function unBanUser($id)
    {
        $user  =  User::findOrFail($id);
        $user->is_banned = false;
        $user->save();
        return response()->json('user UnBanned', 200);
    }

    public function unActiveCommment($id){
        $server =  Server::findOrFail($id);
        $server->comment_active = false;
        $server->save();
        return response()->json('Server Comment UnActive', 200);

    }
    public function activeCommment($id){
        $server =  Server::findOrFail($id);
        $server->comment_active = true;
        $server->save();
        return response()->json('Server Comment active', 200);


    }
}
