<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proveedor;
class proveedorController extends Controller
{
    public function index(){
        return proveedor::all();
    }
}
