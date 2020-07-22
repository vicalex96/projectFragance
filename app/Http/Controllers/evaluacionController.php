<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class evaluacionController extends Controller
{
    public function obtenerListadoInicial(Request $request){
        return $request -> id_productor;
/*
        return DB::select( 
            'select proveedor.id_proveedor, proveedor.nombre, pais.id_pais, pais.nombre as pais
            from vam_condicion_envio as envio, vam_proveedor as proveedor, vam_pais as pais
            where envio.id_pais = pais.id_pais and envio.id_proveedor = proveedor.id_proveedor 
            and envio.id_proveedor in (select mi.id_proveedor 
            from vam_miembro_ifra as mi
            where mi.fecha_final is null)
            and envio.id_pais in (select id_pais 
            from vam_Pais_Prod 
            where vam_Pais_Prod.id_productor = :id)',['id' => $id] );
*/
    }

    public function obtenerListadoRenovacion(Request $request){
        return DB::select('Select * from vam_proveedor' );  
    }


    
}
