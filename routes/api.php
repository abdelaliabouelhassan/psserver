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

Route::get('/user', function (Request $request) {

if(auth('sanctum')->check()){
    return auth('sanctum')->user(); 
}
return response()->json('not logged in',401);

    
});

//auth login and register
Route::post('/register','auth\RegisterAndLoginController@register');
Route::post('/login','auth\RegisterAndLoginController@login');
Route::get('/logout','auth\RegisterAndLoginController@logout');
Route::post('/changepassword', 'auth\RegisterAndLoginController@changepassword');


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



