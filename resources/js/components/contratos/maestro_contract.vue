<template>
<v-component>
    

    <selector-component
    v-show="productor.length == 0"
    class="offset-3"
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
             alert(opcion)
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
            alert(this.productor.nombre)
             
            
         }
     }

 }
</script>

