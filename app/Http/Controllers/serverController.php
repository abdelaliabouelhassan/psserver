<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ServersCollection;
use Spatie\Browsershot\Browsershot;

class serverController extends Controller
{
    public function CreateServer(Request $request)
    {
        
        $request->validate([
            'title' => ['required', 'max:150', 'min:4'],
            'URL' => ['required', 'url'],
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

      

        if ($request->Banner) {

            //take screenshot
            $imgname = uniqid() .'_'. time() . '.png';

            $include_path = trim(shell_exec('npm bin'));
            $delayInMilliseconds = 15000;
            $node_path = $include_path . DIRECTORY_SEPARATOR . 'node';
            $npm_path = $include_path . DIRECTORY_SEPARATOR . 'npm';
            $pathToImage = public_path('uploads/images/' . $imgname);
            // Browsershot::url($request->URL)
            // ->addChromiumArguments(['no-sandbox'])
            // ->setIncludePath($include_path)
            //     ->setNodeBinary($node_path)
            //     ->setNpmBinary($npm_path)
            //     ->waitUntilNetworkIdle()
            //     ->setDelay($delayInMilliseconds)
            //     ->save($pathToImage);

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

            Server::create([
                'title' => $request->title,
                'url' => $request->URL,
                'banner' => $dbPath,
                'category' => $request->Category,
                'language' => $Language,
                'maxlevel' => $request->Level,
                'youtube_id' => $request->YouTube,
                'rates' => $request->Rates,
                'description' => $request->Description,
                'difficulty'=>$request->Difficulty,
                'screen' => $folderPath . $imgname ,
                'user_id' => auth('sanctum')->id(),
            ]);

            return response()->json('Server Created Successfully ', 200);
        }
        return response()->json('Something Went Wrong !', 500);
    }



    public function GetServers(){
         $servers = Server::orderBy('realtimeVote', 'desc')->paginate(15);
        return  ServersCollection::collection($servers);     
    }

    public function GetServerBySlug($slug){
        $servers = Server:: where('slug', $slug)->firstOrFail();
        $servers->viewd = $servers->viewd + 1;
        $servers->save();
        $servers = Server::where('slug',$slug)->get();
         return  ServersCollection::collection($servers); 
    }
}
