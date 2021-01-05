<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ServersCollection;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class serverController extends Controller
{



    public function GenerateLink(Request $request){
        $request->validate([ 
            'URL' => ['required', 'url'],
            'title' => ['required', 'max:150', 'min:4'],
       ]);

       $server =  Server::create([
            'url' => $request->URL,
            'title' => $request->title,
            'user_id' => auth('sanctum')->id(),
        ]);

        $link = url('/serverdetails/' . $server->slug);
        $data = [
            'link'=>$link,
            'id'=>$server->id,
        ];
        return response()->json($data, 200); 
    }

    public function CreateServer(Request $request)
    {
       

        $request->validate([
            'Banner' => ['required'],
            'Category' => ['required'],
            'Language' => ['required'],
            'Level' => ['required'],
            'Rates' => ['required'],
            'Description' => ['required', 'min:50'],
            'Difficulty'=>['required'],
        ]);

        if ($request->YouTube != "") {
            $request->validate([
                'YouTube' => ['url'],
            ]);
        }

        //check recaptcha
        if(!checkRecaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY', '6LeCNhwaAAAAACh31QVu_Fve05EQqn7p9iOWNQmU'),$request->ReqResponse)){
            return response()->json('invalid recaptcha.', 403);
        }


        //check backlink
        
        $server =  Server::findOrFail($request->id);
        $url =  request()->server('SERVER_NAME') . '/'. $server->slug;
        if (!checkBackLink($server->url, $url)) {
            return response()->json('You Need To Add BackLink to your website (' . $server->url . ')!', 403);
        }


        if ($request->Banner) {
            //upload Banner  
            $name = time() . '.'  . explode('/', explode(':', substr($request->Banner, 0, strpos($request->Banner, ';')))[1])[1];
            $folderPath = "uploads/images/";
            $dbPath = "";

            $image_parts = explode(";base64,", $request->Banner);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($folderPath . $name, $image_base64);
            $dbPath =   $folderPath . $name;
          
            $Language = "";
            foreach ($request->Language as $lang) {
                $Language .= $lang . ',';
            }

            $server->update([
                'banner' => $dbPath,
                'category' => $request->Category,
                'language' => $Language,
                'maxlevel' => $request->Level,
                'youtube_id' => $request->YouTube,
                'rates' => $request->Rates,
                'description' => $request->Description,
                'difficulty'=>$request->Difficulty,
                'hasBacklink'=>true,
                'screen' => null ,     
            ]);

            return response()->json('Server Created Successfully ', 200);
        }
        return response()->json('Something Went Wrong !', 500);
    }



    public function GetServers(){
          $servers = Server::orderBy('vote_amount', 'desc')->where('status',true)->where('admin_active', true)->where('server_owner_active', true)->paginate(15);
          return  ServersCollection::collection($servers);     
    }

    public function GetServerBySlug($slug){
        $servers = Server:: where('slug', $slug)->firstOrFail();
        $servers->viewd = $servers->viewd + 1;
        $servers->save();
        $servers = Server::where('slug',$slug)->get();
         return  ServersCollection::collection($servers); 
    }

    public function getMyServers(){
      return   Server::where('user_id',auth('sanctum')->id())->get();

    }

    public function getServerInfo($slug){
      $server =   Server::where('slug',$slug)->where('user_id',auth('sanctum')->id())->first();
      if($server){
          return $server;
      }else{
            return response()->json('Server not found ', 404);
      }

    }


    public function updateServer(Request $request){
        $request->validate([
            'url' => ['required', 'url'],
            'title' => ['required', 'max:150', 'min:4'],
            'banner' => ['required'],
            'category' => ['required'],
            'maxlevel' => ['required'],
            'rates' => ['required'],
            'description' => ['required', 'min:50'],
            'difficulty' => ['required'],
        ]);

        if ($request->YouTube != "") {
            $request->validate([
                'youtube_id' => ['url'],
            ]);
        }


     $server =    Server::findOrFail($request->id);
        //check backlink

        $url =  request()->server('SERVER_NAME') . '/' . $server->slug;
        if (!checkBackLink($server->url, $url)) {
            return response()->json('You Need To Add BackLink to your website (' . $server->url . ')!', 403);
        }


        $banner = $server->banner;

        if($request->banner == $banner){
            $server->update([
                'url' => $request->url,
                'title' => $request->title,
                'banner' => $request->banner,
                'category' => $request->category,
                'maxlevel' => $request->maxlevel,
                'rates' => $request->rates,
                'description' => $request->description,
                'difficulty' => $request->difficulty,
                'status' => false,
                'hasBacklink' => true,
            ]);

        }else{
            $name = time() . '.'  . explode('/', explode(':', substr($request->banner, 0, strpos($request->banner, ';')))[1])[1];
            $folderPath = "uploads/images/";
            $dbPath = "";



            $image_parts = explode(";base64,", $request->banner);
            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($folderPath . $name, $image_base64);
            $dbPath =   $folderPath . $name;

            $server->update([
                'url' => $request->url,
                'title' => $request->title,
                'banner' => $dbPath,
                'category' => $request->category,
                'maxlevel' => $request->maxlevel,
                'rates' => $request->rates,
                'description' => $request->description,
                'difficulty' => $request->difficulty,
                'status' => false,
                'hasBacklink' => true,
            ]);

        }

    

        return response()->json('Server Updated Successfully ', 200);

        
    }

    public function getserverbyserver($server){
        $servers = Server::orderBy('vote_amount', 'desc')->where('language','like' , '%' .$server . '%')->where('status', true)->paginate(15);
        return  ServersCollection::collection($servers);    
    }


    public function Active(Request $request){
              $server =   Server::findOrFail($request->id);
              if($server->user_id == auth('sanctum')->id() && $server->admin_active && $server->status){
                    $server->server_owner_active = true;
                    $server->save();
            return response()->json('Server Activated  Successfully ', 200);
              }
    }

      public function Deactivate(Request $request){
        $server =   Server::findOrFail($request->id);
        if ($server->user_id == auth('sanctum')->id() && $server->admin_active && $server->status) {
            $server->server_owner_active = false;
            $server->save();
            return response()->json('Server Deactivated Successfully', 200);
        }
    }

}
