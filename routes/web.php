<?php

use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
use Longman\IPTools\Ip;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Server;
use App\BacklinkChecker;
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

   return request()->server('SERVER_NAME');

   return checkBackLink('https://www.youtube.com/', 'https://www.youtube.com/');

 


  


  
    
});

Route::get('/take',function (){

    //    Browsershot::url('https://freek.dev/881-introducing-browsershot-v3-the-best-way-to-convert-html-to-pdfs-and-images')
    //        ->setNodeBinary('C:\Program Files\nodejs\node.exe')
    //       ->save('test.png');


    
// $url = 'https://sepherion2.biz/';

// $imgname = uniqid() . '.png';

// $include_path = trim(shell_exec('npm bin'));

// $node_path = $include_path . DIRECTORY_SEPARATOR . 'node';
// $npm_path = $include_path . DIRECTORY_SEPARATOR . 'npm';
//     $pathToImage = public_path('/' . $imgname);
//     Browsershot::url($url)
//         ->addChromiumArguments(['no-sandbox'])
//         ->setIncludePath($include_path)
//         ->setNodeBinary($node_path)
//         ->setNpmBinary($npm_path)
//     ->save($pathToImage);

 
    $pathToImage = public_path('/test.png');
    $delayInMilliseconds = 20000;
    Browsershot::url('https://www.youtube.com/')
        ->setNodeBinary('C:/node_testing/nodejs/node.exe')
         ->noSandbox()->timeout(30)
        ->save($pathToImage);

    // $pathToImage = public_path('/test.png');
    // $delayInMilliseconds = 20000;
    // Browsershot::url('https://sepherion2.biz/')
    // ->waitUntilNetworkIdle(false)
    // ->save($pathToImage);
    // return '<img src="/' . $imgname . '" />';

});
Route::get('/verifyemail/{email}/{token}','auth\RegisterAndLoginController@verifyemail');


Route::get('/', function () {
    return view('master');
});

Route::get('{path}',function (){
    return view('master');
})->where('path','[a-zA-Z0-9-/]+');
