<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class serverController extends Controller
{
    public function CreateServer(Request $request){
            return $request->all();
    }
}