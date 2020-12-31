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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth login and register
Route::post('/register','auth\RegisterAndLoginController@register');
Route::post('/login','auth\RegisterAndLoginController@login');
Route::get('/logout','auth\RegisterAndLoginController@logout');


//Verification email
Route::middleware('auth:sanctum')->post('/Verification', 'auth\RegisterAndLoginController@Verification');


//servers
Route::middleware('auth:sanctum')->post('/createserver', 'serverController@CreateServer');


