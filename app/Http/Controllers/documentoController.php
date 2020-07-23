<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class documentoController extends Controller
{
    public function store(Request $request){
        if( $request ->buscar == 'proveedores'){
            $id_productor = $request->id;
            $tipo = $request->tipo;
            return DB::select("
                select resultado.fecha, resultado.resultado, formula.peso as nota_minima, 
                       prov.id_proveedor, prov.nombre as nombre_proveedor,
                       prod.id_productor, prod.nombre as nombre_producdor
                from vam_resultado_evaluacion as resultado, vam_evaluacion_criterio as formula, vam_proveedor as prov, vam_productor as prod
                where formula.peso in( select formula.peso 
                    from vam_evaluacion_criterio as formula, vam_productor as productor, vam_variable as variable
                    where formula.id_variable = variable.id_variable 
                    AND variable.id_variable in(  select vam_variable.id_variable
                        from vam_variable 
                        where vam_variable.nombre = 'Exito en evaluacion' )
                    and resultado.id_productor = formula.id_productor
                    and formula.fecha_fin IS NULL
                    and formula.tipopor = '$tipo'
                    and productor.id_productor = '$id_productor ' )
                and  formula.id_productor = resultado.id_productor
                and  resultado.resultado >= formula.peso
                and  resultado.fecha >= formula.fecha_inicio
                and  prov.id_proveedor = resultado.id_proveedor
                and  prod.id_productor = resultado.id_productor
                and  prod.id_productor = '$id_productor '
                and  formula.tipopor = '$tipo'
                group by resultado.fecha, resultado.resultado,formula.peso, prov.id_proveedor, prov.nombre, prod.id_productor, prod.nombre"
            );
        }
        if( $request ->buscar == 'productos'){
                $id_proveedor= $request->id;
                return DB::select("select Producto_No_Exclusivo
                from (select ie.nombre as Producto_No_Exclusivo
                        from vam_elemento_contrato as ec, vam_ingrediente_esencia as ie
                        where (ec.id_ingrediente_esencia = ie.id_ingrediente_esencia) and ec.id_contrato in (select con.id_contrato 
                                from vam_contrato as con 
                                where con.exclusividad='no' and  id_proveedor = '$id_proveedor')  
                        
                        UNION ALL
                        select io.nombre as Producto_No_Exclusivo
                        from vam_elemento_contrato as ec, vam_ingrediente_otro as io
                        where (ec.id_ingrediente_otro = io.id_ingrediente_otro) and ec.id_contrato in (select con.id_contrato
                                        from vam_contrato as con 
                                        where con.exclusividad='no' and id_proveedor= '$id_proveedor'))ProductosExclusivos;
                ");
            
        }
        if( $request ->buscar == 'condiciones-pago'){
            $id_proveedor= $request->id;
            return DB::select("
            select pago.id_condicion_pago, pago.tipo_condicion,pago.descripcion, pago.cuotas, pago.porcen_cuota, meses_cuotas
            from vam_condicion_pago as pago, vam_proveedor as prov
            where prov.id_proveedor = pago.id_proveedor
              and prov.id_proveedor = '$id_proveedor';
            ");
        }
        if( $request ->buscar == 'condiciones-envio'){
            $id_proveedor= $request->id;
            return DB::select(" 
                select envio.id_condicion_envio, envio.medio_transporte, envio.costo, pais.nombre 
                from vam_proveedor as prov, vam_condicion_envio as envio, vam_pais as pais
                where  prov.id_proveedor = '$id_proveedor' 
                    and prov.id_proveedor = envio.id_proveedor
                    and envio.id_pais = pais.id_pais;
            ");
        }
        return"mariconson";
    }    
}
