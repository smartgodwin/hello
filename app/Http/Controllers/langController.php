<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class langController extends Controller
{
   public function setlang($lang){
    App::setLocale($lang);
    Session::put("locale", $lang);
    return redirect()->back();
   }
}
