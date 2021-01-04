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

        //check backlink
        $server =  Server::findOrFail($request->id);
        $response = Http::get($server->url);
        $data = $response->body();
        if (!Str::contains($data, ['<a href="' . url('/serverdetails/' . $server->slug) . '" title="Metin2 P Server">Metin2 P Server</a>'])) {
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
                'screen' => null ,     
            ]);

            return response()->json('Server Created Successfully ', 200);
        }
        return response()->json('Something Went Wrong !', 500);
    }



    public function GetServers(){
          $servers = Server::orderBy('previousVote', 'desc')->where('status','true')->paginate(15);
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
                'status' => 'false',
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
                'status' => 'false',
            ]);

        }

    

        return response()->json('Server Updated Successfully ', 200);

        
    }

    public function getserverbyserver($server){
        $servers = Server::orderBy('previousVote', 'desc')->where('language','like' , '%' .$server . '%')->where('status', 'true')->paginate(15);
        return  ServersCollection::collection($servers);    
    }

}
