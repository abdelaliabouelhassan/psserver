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
use App\Enums\ServerRanking;
use App\Mail\ServerBackLink;
use Illuminate\Support\Facades\Mail;
use  \Illuminate\Support\Facades\App;
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
    App::setLocale('fr');
   return trans('message.invalid_recaptcha');
    
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


route::group(['middleware'=> 'only_admin'],function () {
//admins

Route::resource('admin', 'admin\StatistiController');
Route::resource('users', 'admin\UsersManageController');
Route::resource('servers', 'admin\ServerManageController');

Route::get('ban_unban/{user_id}', 'admin\UsersManageController@ban_user_and_unban')->name('ban');
Route::post('active_server_deactivate', 'admin\ServerManageController@active_server_deactivate')->name('active_server_deactivate');
Route::post('active_comment_deactivate', 'admin\ServerManageController@active_comment_deactivate')->name('active_comment_deactivate');
Route::post('delete_Comment', 'admin\ServerManageController@delete_Comment')->name('delete_Comment');
Route::get('un_active_servers', 'admin\ServerManageController@get_un_active_servers')->name('get_un_active_servers');
Route::get('un_approve_servers', 'admin\ServerManageController@get_un_approve_servers')->name('get_un_approve_servers');
Route::post('approve_server', 'admin\ServerManageController@approve_server')->name('approve_server');
Route::get('logout', 'admin\UsersManageController@logout')->name('logout');

});



//clients 
Route::get('/', function () {
    return view('master');
});

Route::get('{path}',function (){
    if(session()->has('lang')){
        App::setLocale(session()->get('lang'));
    }else{
        session(['lang' => 'en']);
        App::setLocale('en');
    }
    return view('master');
})->where('path','[a-zA-Z0-9-/]+');
