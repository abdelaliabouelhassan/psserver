<?php

use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
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

Route::get('/test', function (Request $request) {
    function getIPAddress()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    $ip = getIPAddress();
    return 'User Real IP Address - ' . $ip; 
    
});

Route::get('/take',function (){

    //    Browsershot::url('https://freek.dev/881-introducing-browsershot-v3-the-best-way-to-convert-html-to-pdfs-and-images')
    //        ->setNodeBinary('C:\Program Files\nodejs\node.exe')
    //       ->save('test.png');

    $pathToImage = public_path('/test.png');
    $delayInMilliseconds = 20000;
    Browsershot::url('https://sepherion2.biz/')
        ->setNodeBinary('C:/node_testing/nodejs/node.exe')
         ->noSandbox()->timeout(30)
        ->save($pathToImage);

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
