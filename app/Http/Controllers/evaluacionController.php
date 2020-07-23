<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class evaluacionController extends Controller
{
    public function obtenerListadoInicial(Request $request){
        $nombre = $request -> id_productor;

        return DB::select( 
            `select proveedor.id_proveedor, proveedor.nombre, pais.id_pais, pais.nombre as pais
            from vam_condicion_envio as envio, vam_proveedor as proveedor, vam_pais as pais
            where envio.id_pais = pais.id_pais and envio.id_proveedor = proveedor.id_proveedor 
            and envio.id_proveedor in (select mi.id_proveedor 
            from vam_miembro_ifra as mi
            where mi.fecha_final is null)
            and envio.id_pais in (select id_pais 
            from vam_Pais_Prod 
            where vam_Pais_Prod.id_productor = LOWER('$nombre')`);

    }

    public function obtenerListadoRenovacion(Request $request){
        $id_productor = $request->id;
        return DB::select(" 
        select * from vam_proveedor where vam_proveedor.id_proveedor in(
            select proveedor.id_proveedor 
            from vam_proveedor as proveedor, 
                 vam_productor as productor, 
                 vam_contrato as contrato
            where contrato.id_productor = productor.id_productor
                and contrato.id_proveedor = proveedor.id_proveedor 
                and productor.id_productor = '$id_productor'
                and 365 - (current_date - contrato.fecha_inicio) <= 30 
                and 365 - (current_date - contrato.fecha_inicio) >=0
            )
        ");
    }


    
}
