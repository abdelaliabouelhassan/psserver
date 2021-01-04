<?php

use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
use Longman\IPTools\Ip;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Server;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/test',function(){
//    return request()->getClientIp();
// });
use  \Illuminate\Support\Carbon;

Route::get('/test', function () {

   

  $current_servers = Server::orderBy('realtimeVote', 'desc')->where('status', 'true')->get();
$previous_servers = Server::orderBy('previousVote', 'desc')->where('status', 'true')->get();

foreach ($current_servers as $current_server_pos => $current_server)
{
    $up_down = 'down';

    foreach ($previous_servers as $previous_server_pos => $previous_server)
    {
        // If the current position of the server is lower than the
        // positions of the previous servers, which do not have the same ID,
        // we can assume that the server is now at a higher position.
        if ($current_server_pos < $previous_server_pos)
        {
            $up_down = 'up';
            break;
        }

        // If we found the current server in the array of previous servers.
        if ($current_server->id === $previous_server->id)
        {
            // We can assume that it is lower or the same.
            $up_down = $current_server_pos > $previous_server_pos  ? 'down' : 'stable';
            
            break;
        }
    }

    $current_server->upDown = $up_down;
    $current_server->previousVote = $current_server->realtimeVote;
    $current_server->save();
}

  


  
    
});

Route::get('/take/',function (){

    //    Browsershot::url('https://freek.dev/881-introducing-browsershot-v3-the-best-way-to-convert-html-to-pdfs-and-images')
    //        ->setNodeBinary('C:\Program Files\nodejs\node.exe')
    //       ->save('test.png');


    
$url = 'https://sepherion2.biz/';

$imgname = uniqid() . '.png';

$include_path = trim(shell_exec('npm bin'));

$node_path = $include_path . DIRECTORY_SEPARATOR . 'node';
$npm_path = $include_path . DIRECTORY_SEPARATOR . 'npm';
    $pathToImage = public_path('/' . $imgname);
    Browsershot::url($url)
        ->addChromiumArguments(['no-sandbox'])
        ->setIncludePath($include_path)
        ->setNodeBinary($node_path)
        ->setNpmBinary($npm_path)
    ->save($pathToImage);

    return '<img src="/'. $imgname. '" />';
    // $pathToImage = public_path('/test.png');
    // $delayInMilliseconds = 20000;
    // Browsershot::url('https://sepherion2.biz/')
    //     ->setNodeBinary('C:/node_testing/nodejs/node.exe')
    //      ->noSandbox()->timeout(30)
    //     ->save($pathToImage);

    // $pathToImage = public_path('/test.png');
    // $delayInMilliseconds = 20000;
    // Browsershot::url('https://sepherion2.biz/')
    // ->waitUntilNetworkIdle(false)
    // ->save($pathToImage);


});
Route::get('/verifyemail/{email}/{token}','auth\RegisterAndLoginController@verifyemail');


Route::get('/', function () {
    return view('master');
});

Route::get('{path}',function (){
    return view('master');
})->where('path','[a-zA-Z0-9-/]+');
