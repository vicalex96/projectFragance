<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\productor;
class productorController extends Controller
{
    public function index(){
        return productor::all();
    }
}
