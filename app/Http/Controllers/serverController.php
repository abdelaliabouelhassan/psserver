<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ServersCollection;


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
            'YouTube' => ['required', 'url'],
            'Rates' => ['required'],
            'Description' => ['required', 'min:50']
        ]);


        if ($request->Banner) {
            $name = time() . '.'  . explode('/', explode(':', substr($request->Banner, 0, strpos($request->Banner, ';')))[1])[1];
            $folderPath = "uploads/images/";
            $dbPath = "";
            if ($request->isGif) {

                $image_parts = explode(";base64,", $request->Banner);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                file_put_contents($folderPath . $name, $image_base64);
                $dbPath =   $folderPath . $name;
            } else {
                $img =   Image::make($request->Banner);
                $img->save(public_path($folderPath) . $name);
                $dbPath =   $folderPath . $name;
            }
            $Language = "";
            foreach ($request->Language as $lang) {
                $Language = $lang . ',';
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
                'user_id' => auth('sanctum')->id(),
            ]);

            return response()->json('Server Created Successfully ', 200);
        }
        return response()->json('Something Went Wrong !', 500);
    }



    public function GetServers(){
        $servers = Server::all();
        return  ServersCollection::collection($servers);     
    }
}
