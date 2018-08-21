<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ConfigureController extends Controller
{
    public function configure(){
    	return view('config.config');
    }
}
