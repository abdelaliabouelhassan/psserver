<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \Illuminate\Support\Facades\App;

class AppSettingsController extends Controller
{
    public function changLang(Request $request)
    {
        session(['lang' => $request->lang]);
        App::setLocale($request->lang);
        return response()->json($request->lang, 200);
    }

    public function getLang()
    {
        return session()->get('lang');
    }
}
