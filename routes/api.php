<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

route::group(['middleware' => 'check_lang'], function () {

    Route::get('/user', function (Request $request) {

        if (auth('sanctum')->check()) {
            return auth('sanctum')->user();
        }
        return response()->json('not logged in', 401);
    });

    //auth login and register
    Route::post('/register', 'auth\RegisterAndLoginController@register');
    Route::post('/login', 'auth\RegisterAndLoginController@login');
    Route::get('/logout', 'auth\RegisterAndLoginController@logout');
    Route::post('/changepassword', 'auth\RegisterAndLoginController@changepassword');

    //forgot password

    Route::post('/forgotpassword', 'auth\RegisterAndLoginController@forgotPassword');
    //forgot password check code  

    Route::post('/checkCode', 'auth\RegisterAndLoginController@checkCode');
    //change password

    Route::post('/changepassword', 'auth\RegisterAndLoginController@changeforgotPassword');


    //Verification email
    Route::middleware('auth:sanctum')->post('/Verification', 'auth\RegisterAndLoginController@Verification');


    //servers
    Route::middleware('auth:sanctum')->post('/createserver', 'serverController@CreateServer');
    Route::middleware('auth:sanctum')->post('/GenerateLink', 'serverController@GenerateLink');
    Route::get('/GetServers', 'serverController@GetServers');
    Route::get('/GetServer/{slug}', 'serverController@GetServerBySlug');
    Route::get('/getMyServers', 'serverController@getMyServers');
    Route::get('/getServerInfo/{slug}', 'serverController@getServerInfo');
    Route::post('/updateServer', 'serverController@updateServer');
    Route::get('/GetServers/{server}', 'serverController@getserverbyserver');
    //vote
    Route::post('/Vote', 'VotesController@Vote');



    //comments
    Route::get('/getComments/{slug}', 'VotesController@GetComments');
    Route::post('/replay', 'VotesController@Replay');
    Route::post('/addComment', 'VotesController@addComment');


    //cotactus
    Route::post('/Contactus', 'ContactUsController@Contactus');



    //active & Deactivate server owner 

    Route::post('/Deactivate', 'serverController@Deactivate');
    Route::post('/Active', 'serverController@Active');


    //change lang

    Route::post('/changLang', 'AppSettingsController@changLang');
    Route::get('/getLang', 'AppSettingsController@getLang');


    //app banners

    Route::get('/GetBanners', 'AppSettingsController@GetBanners');
    Route::get('/GetfeathredServer', 'AppSettingsController@GetfeathredServer');
    Route::get('/getUrl', 'AppSettingsController@getUrl');
    Route::get('/GetfeathredServerComment', 'AppSettingsController@GetfeathredServerComment');
    Route::get('/deleteComment/{id}', 'AppSettingsController@deleteComment');
    Route::get('/banuser/{id}', 'AppSettingsController@banUser');
    Route::get('/Unbanuser/{id}', 'AppSettingsController@unBanUser');
    Route::get('/unactive/{id}', 'AppSettingsController@unActiveCommment');
    Route::get('/active/{id}', 'AppSettingsController@activeCommment');
  

});
