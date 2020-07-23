/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(Vuetify);

Vue.component('header-component', require('./components/general/header.vue').default);
Vue.component('recomendador-component', require('./components/Recomendador.vue').default);

Vue.component('formula-component', require('./components/evaluaciones/formula-eval.vue').default);
Vue.component('escala-component', require('./components/evaluaciones/escala-eval.vue').default);
Vue.component('opciones-formula-component', require('./components/evaluaciones/opciones-formula-eval.vue').default);
Vue.component('maestroeval-component', require('./components/evaluaciones/maestro_eval.vue').default);
Vue.component('selector-component', require('./components/general/selector.vue').default);
Vue.component('evaluar-proveedores', require('./components/evaluaciones/evaluar_proveedores.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify()
});

/*
1.Crear evaluación (filtro productor)
1.1 tipo (inicial, renovación)
1.2 lista de criterios 
1.2.1 elegir cada criterio y asignar peso% (incluye elegir criterio de éxito) – guardar con la fecha pertinente. Se hace completo no por partes – o sea la interfaz debe pedir criterios hasta que el usuario diga que culminó – en el caso del proyecto 3 criterios más criterio éxito (eval inicio); 1 criterio más criterio éxito(eval renueva).
1.3 crear escala - guardar

2.Realizar evaluación(filtro productor)
2.1 tipo eval
2.2 si es inicial mostrar todos los proveedores potenciales (filtro de lugar envió y membresía IFRA activa)
2.3 elegir el proveedor- mostrar condiciones de pago, envíos y productos
2.4 preguntar valoración para cada criterio
2.5 calcular – mostrar resultado más aprobación o no.
2.6 si es aprobado preguntar si se quiere generar contrato (equivale a la confirmación proveedor)
2.6.1 preguntar productos, preguntar condiciones envío y pago a tomar – crear contrato (guardar toda la info pertinente en la b/d)
    pasos para implementar la 2.6.1
    2.6.1: 1-entrar al menu de contratos
           2-seleccionar el productor
           3-lista de evaluaciones aprovadas (
                comparar con el contrato mas reciente, 
                    si esta evaluacion es despues del ultimo contrato pues se acepta
                    si es de antes no aparce 
                    )
            4-preguntar por productos: tenemos que ver todos los productos del 
            proveedor que no sean exclusivos
                (UNA CONSULTA con contratos,ingrediente_esencia, ingrediente_otro,)
            5-preguntar por las condiciones de envio de la empresa (seleccionar de la lista)
            6-preguntar por las condiciones de pago(seleccionar de la lista)
            7-crear el contrato

2.1 si es renovación
2.2 listar proveedores con contratos a vencer
2.3 elegir
2.4 preguntar valoración para cada criterio
2.5 calcular – mostrar resultado más aprobación o no.
2.6 si es aprobado preguntar si se quiere renovar – sí – crea registro en renovación. - No - pregunta si se quiere generar un contrato nuevo (porque quieren cambiar alguna condición) y se repiten los pasos 2.6.1

3.Cancelar contrato manual (filtro productor)
3.1 muestra contratos vigentes – selecciona
3.2 indica quién cancela, motivo – se guarda con la fecha pertinente.

*/
