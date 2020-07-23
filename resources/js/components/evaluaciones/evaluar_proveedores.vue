<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="12">
                realizar evaluacion 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-left " cols="4">
               <p>productor: -- {{productor.nombre}} -- </p> 
            </v-col>
            <v-col class="blue lighten-2 white--text text-center " cols="4">
                <p v-if="empresaProveedora">proveedor: -- {{empresaProveedora.nombre}} --</p> 
            </v-col>
            <v-col class="blue lighten-2 white--text text-right " cols="4">
                <p v-if="paisEnvios">pais de preferencia: -- {{paisEnvios.nombre}} --</p> 
            </v-col>
        </v-row>
                <v-row>
            <v-col class="blue darken-2 text-right white--text pa-5" cols="3">
                tipo de evaluacion   
            </v-col>
            <v-col class="blue lighten-5" cols="1" > </v-col>
            <v-col class="blue lighten-5" cols="8">
                    <v-radio-group v-model="tipoEval"  @change="cargarLista(tipoEval)" row>
                      <v-radio label="inicial"    value='inicial'></v-radio>
                      <v-radio label="renovacion" value='renovacion'></v-radio>
                    </v-radio-group> 
           </v-col>
        </v-row>
        <v-row v-if="tipoEval=='inicial'">
            <v-col class="blue darken-2 white--text text-right pa-5" cols="3">
                  pais
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="dialog1" scrollable max-width="300px">
                    <template v-slot:activator="{ on}">
                        <v-btn
                        :disabled=" paises.length == 0"
                         color="warning"
                        dark
                        v-on="on"
                        >
                        seleccionar lugar envio
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir pais</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-radio-group v-model="paisEnvios" v-for="pais in paises" :key="pais.id_pais" column>
                                <v-radio :label="pais.nombre" :value="pais"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="cargarListaProveedores">aceptar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="3">
                  proveedores
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="dialog2" scrollable max-width="300px">
                    <template v-slot:activator="{ on }">
                        <v-btn
                        :disabled="desactivado"
                         color="primary"
                        dark
                        v-on="on"
                        >
                        listado de proveedores
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir proveedor</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-radio-group v-model="empresaProveedora" v-for="proveedor in proveedores" :key="proveedor.id_proveedor" column>
                                <v-radio :label="proveedor.nombre" :value="proveedor"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="dialog2 = false ">aceptar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
        </v-row>
    </v-container>
</template>



<script>
import axios from'axios'
export default {
    props:['productor'],
    data(){
        return{
            tipoEval:null,
            empresaProveedora: '',
            paisEnvios:'',
            dialog1: false,
            dialog2: false,
            proveedoresInicial:[],
            proveedoresRenovacion:[],
            proveedores:[],
            paises:[],
            desactivado: true,
        }
    },
    methods:{
        cargarLista(tipoEval){

            if(tipoEval== 'inicial'){
                console.log('hola')
                this.paises = []
                this.paisEnvios = ''
                this.empresaProveedora = null
                this.cargarListaPaises()
                this.desactivado = true
                return;
            }

            if(this.tipoEval == 'renovacion'){
                this.paises = []
                this.paisEnvios = ''
                this.empresaProveedora = '' 
                this.desactivado = false
                this.cargarListaProveedores()
            }
        },
        cargarListaProveedores(){
            
             if(this.tipoEval== 'inicial'){
                 this.empresaProveedora = '' 
                const params = {
                    tipo_buqueda : 'inicial',
                    nombre: this.paisEnvios.nombre,
                }
                axios.post(`/proveedores`,params)
                .then((response)=>{
                    this.proveedoresInicial = response.data;
                    this.proveedores = response.data;
                })
                this.dialog1 = false
                this.desactivado = false  
                

            }else if(this.tipoEval == 'renovacion'){
                console.log('hola')
                const params = {
                    tipo_buqueda : 'renovacion',
                    id : this.productor.id_productor
                }
                axios.post(`/proveedores`,params)
                .then((response)=>{
                    console.log('ejecutado')
                    this.proveedoresRenovacion = response.data;
                    this.proveedores = response.data;
                })
            }
        },
        cargarListaPaises(){
            axios.get(`/paises/${this.productor.id_productor}`)
            .then((response)=>{
                    this.paises = response.data;
            });
        }
    },
}
</script>