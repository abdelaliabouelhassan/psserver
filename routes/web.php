<?php

use App\Models\AppSettings;
use App\Models\Meta;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
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



Route::get('/verifyemail/{email}/{token}', 'auth\RegisterAndLoginController@verifyemail');

route::group(['middleware' => 'only_admin'], function () {
    //admins

    Route::resource('admin', 'admin\StatistiController');
    Route::resource('users', 'admin\UsersManageController');
    Route::resource('servers', 'admin\ServerManageController');

    Route::get('ban_unban/{user_id}', 'admin\UsersManageController@banUserAndUnban')->name('ban');
    Route::post('active_server_deactivate', 'admin\ServerManageController@deactivateActiveServer')->name('active_server_deactivate');
    Route::post('active_comment_deactivate', 'admin\ServerManageController@activeCommentDeactivate')->name('active_comment_deactivate');
    Route::post('delete_Comment', 'admin\ServerManageController@deleteComment')->name('delete_Comment');
    Route::get('un_active_servers', 'admin\ServerManageController@getUnActiveServer')->name('get_un_active_servers');
    Route::get('un_approve_servers', 'admin\ServerManageController@getUnApprovedServers')->name('get_un_approve_servers');
    Route::post('approve_server', 'admin\ServerManageController@approveServer')->name('approve_server');
    Route::get('add_banners', 'admin\AppSettingController@index')->name('add_banners');
    Route::post('add_banner', 'admin\AppSettingController@addBanner')->name('add_banner');
    Route::post('add_youtube_url', 'admin\AppSettingController@addUrl')->name('add_youtube_url');
    Route::get('set_feathred_server/{id}', 'admin\AppSettingController@setFeathredServer')->name('set_feathred_server');
    Route::post('change_title', 'admin\AppSettingController@changeTitle')->name('change_title');
    Route::post('add_meta', 'admin\AppSettingController@addMeta')->name('add_meta');
    Route::get('delete_meta/{id}', 'admin\AppSettingController@deleteMeta')->name('delete_meta');
    Route::post('update_meta/{id}', 'admin\AppSettingController@updateMeta')->name('update_meta');

    Route::get('logout', 'admin\UsersManageController@logout')->name('logout');
});



//clients 
Route::get('/', function () {
    $meta = Meta::all();
    if (session()->has('lang')) {
        App::setLocale(session()->get('lang'));
    } else {
        session(['lang' => 'en']);
        App::setLocale('en');
    }
    $title = "";
    $app =  AppSettings::first();
    if ($app) {
        $title = $app->app_title;
    } else {
        $title = "TopList";
    }
    return view('master', compact('title', 'meta'));
    return view('master');
});

Route::get('{path}', function () {
    $meta = Meta::all();
    if (session()->has('lang')) {
        App::setLocale(session()->get('lang'));
    } else {
        session(['lang' => 'en']);
        App::setLocale('en');
    }
    $title = "";
    $app =  AppSettings::first();
    if ($app) {
        $title = $app->app_title;
    } else {
        $title = "TopList";
    }
    return view('master', compact('title', 'meta'));
})->where('path', '[a-zA-Z0-9-/]+');
