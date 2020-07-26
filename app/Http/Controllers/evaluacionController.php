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

    public function obtenerVariables() {
        return DB::select("select * from vam_variable");
    }

    public function crearFormula(Request $request){
        $params = json_decode($request->criterios, true);
        return DB::transaction(function(){
            foreach($params as $criterios => $id_variable) 
            {
                DB::insert("insert into 
                vam_evaluacion_criterio(id_productor,id_variable,fecha_inicio,peso,tipopor) 
                values('$request->id_productor',
                '$criterio->id_variable',
                current_date,
                $criterio->peso,$request->tipoEval)");
            }
        });
    }
    public function crearEscala(Request $request){

        $ultimaEscala = DB::table('vam_escala_valorada')->orderBy('id_escala','DESC')->first();
        $id_productor = $request->id_productor;
        $id_escala_v = $ultimaEscala->id_escala;
        ++$id_escala_v;
        $r_inicio = $request->rango_inicio;
        $r_final = $request->rango_final;
        return DB::insert("insert into vam_escala_valorada(id_productor, id_escala,fecha_inicio,rango_inicio,rango_fin) 
        values('$id_productor','$id_escala_v',current_date,'$r_inicio','$r_final');");
    }

    public function obteneSrFormulas(Request $request){
        $id_productor = $request;
        return DB::select("select 
                criterio.id_variable, SS
                criterio.fecha_inicio, 
                variable.nombre, 
                criterio.peso, 
                criterio.tipopor 
            from vam_evaluacion_criterio as criterio, 
                vam_variable as variable
            where criterio.id_variable = variable.id_variable 
                and variable.id_variable = criterio.id_variable
                and criterio.fecha_fin is null
                and criterio.id_productor = '$id_productor'");
    }


}
