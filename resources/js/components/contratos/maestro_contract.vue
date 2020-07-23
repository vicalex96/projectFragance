<template>
<v-row>
        <opciones-eval-component
    class="offset-3"
    v-show="productor.length != 0 && opcion == 'menu'"
    :productor="productor"

    @abrirVentana = "abrirCreacionContrato(...arguments)"
    ></opciones-eval-component>

    <crear-contrato-component
    class="offset-1"
    v-show="productor.length != 0 && opcion == 'menuCrear'"
    :productor="productor"
        :proveedores="proveedores"
    ></crear-contrato-component>

    <selector-component
    v-show="productor.length == 0"
    class="offset-3"
    :lista="lista"
    :tipo="tipo"
    @elementSelect = "selecionarProveedor( ...arguments)"
    ></selector-component>
</v-row>


</template>

<script>
import axios from 'axios'
 export default{
     data(){
         return{
            tipo:'elegir productores',
            lista:[],
            proveedores:[],
            productor:'',
            escalaView: false,
            opcion:'menu',
            tipoEval : '',
         }
     },
    mounted(){
        axios.get('/productores').then((response)=>{
            this.lista = response.data;
        })
    },
     methods:{
        selecionarProveedor( elemento){
            this.productor = elemento
        },
        abrirCreacionContrato(tipoEval){
            this.tipoEval  = tipoEval
        },
        cargarEvalProbrovadas(){
            const params = {
                id: this.productor.id_productor
            }
            axios.post('/evaluaciones',params).then((response)=>{
                this.lista = response.data;
                console.log(response.data)
            })
        },
        cargarProveedores(){
               const params = {
                    buscar : 'proveedores',
                    id : this.productor.id_productor,
                    tipo : 'inicial'
                }
                axios.post("/contratosOpetations",params).then((response)=>{
                    this.proveedores = response.data
                })
        },
        abrirCreacionContrato(tipoEval){
            this.cargarProveedores()
            if(tipoEval == "inicial"){
                this.opcion = 'menuCrear'
            }
            if(tipoEval == "renovacion"){
                this.opcion = 'menuRenovar'
            }
        }
     }

 }
</script>

