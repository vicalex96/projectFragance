<template>
<v-component>
    <opciones-formula-component
    class="offset-3"
    :productor="productor"
    v-show = " productor.length != 0 &&  opcion == 'menu' "
    @opcionFormula = "elegirOpcion(...arguments)"
    @opcionEvaluacion = "elegirOpcion(...arguments)"
    > </opciones-formula-component>

    <escala-component
    v-show="opcion == 'escala'"
    :productor="productor"
    ></escala-component>

    <formula-component
    v-show="opcion == 'formula'"
    :productor="productor"
    ></formula-component>

    <evaluar-proveedores
    v-show="opcion == 'evaluacion'"
    :productor="productor"
    ></evaluar-proveedores> 

    <selector-component
    v-show="productor.length == 0"
    class="offset-4"
    :lista="lista"
    :tipo="tipo"
    @elementSelect = "selecionarProveedor( ...arguments)"
    ></selector-component>
</v-component>


</template>

<script>
import axios from 'axios'
 export default{
     data(){
         return{
            tipo:'productores',
            lista:[],
            productor:[],
            escalaView: false,
            opcion:'menu',
         }
     },
    mounted(){
        axios.get('/productores').then((response)=>{
            this.lista = response.data;
        })
    },
     methods:{
         elegirOpcion(opcion){
             this.opcion = opcion
         },
         agregarComentario(comentario){
            axios.get('/familia').then((response)=>{
            this.lista = response.data;
            })
         },
         eliminaComentario(index){
             this.comentarios.splice(index,1)
         },
        selecionarProveedor( elemento){
            this.productor = elemento
             
            
         }
     }

 }
</script>
