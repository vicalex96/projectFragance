<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proveedor;
use DB;
class proveedorController extends Controller
{
    public function index(){
        return proveedor::all();
    }

    public function store(Request $request){
        if($request->tipo_buqueda == 'inicial'){
            $nombre = $request->nombre ;
            return DB::select("
                select proveedor.id_proveedor as id,proveedor.nombre
                from vam_proveedor as proveedor
                where proveedor.id_proveedor in(
                    select proveedor.id_proveedor
                    from vam_proveedor as proveedor, 
                         vam_condicion_envio as envio, 
                         vam_pais as pais
                    where proveedor.id_proveedor in(
                        select proveedor.id_proveedor 
                        from vam_miembro_ifra as ifra, vam_proveedor as proveedor
                        where ifra.id_proveedor = proveedor.id_proveedor and ifra.fecha_final IS NULL
                        )
                      and envio.id_proveedor = proveedor.id_proveedor
                      and pais.id_pais = envio.id_pais 
                      and LOWER(pais.nombre) = LOWER('$nombre'))" );
        }
        if($request->tipo_buqueda == 'renovacion'){
            $id_productor = $request->id;
            return DB::select(" 
            select * from vam_proveedor where vam_proveedor.id_proveedor in(
                select proveedor.id_proveedor 
                from vam_proveedor as proveedor, 
                     vam_productor as productor, 
                     vam_contrato as contrato
                where contrato.id_productor = productor.id_productor
                    and contrato.id_proveedor = proveedor.id_proveedor 
                    and productor.id_productor = $id_productor
                    and (contrato.fecha_inicio - current_date ) <= 30 
                    and (contrato.fecha_inicio - current_date ) >= 0
	            )
            ");
        }


    }
}
