<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pais;
use DB;
class paisController extends Controller
{
    public function show($id){
        return DB::select('select pais.id_pais, pais.nombre from vam_pais as pais, vam_pais_prod as pivote
        where(pivote.id_productor = ? and pais.id_pais = pivote.id_pais)',[$id] );
    }
}
