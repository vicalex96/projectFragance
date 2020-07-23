<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1" cols="12">
                realizar evaluacion 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center " cols="6">
               <p>productor: -- {{productor.nombre}} -- </p> 
            </v-col>
            <v-col class="blue lighten-2 white--text text-center " cols="6">
                <p v-if="proveedor">proveedor: -- {{proveedor.nombre_proveedor}} --</p> 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="3">
                  proveedores <p>(evaluaciones aprovadas)</p>
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="provDialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on}">
                        <v-btn
                        :disabled="botonProveedor"
                         color="warning"
                        dark
                        v-on="on"
                        >
                        seleccionar proveedor
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir proveedor</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-radio-group v-model="proveedor" v-for="elemento in proveedores" :key="elemento.id_proveedor" column>
                                <v-radio :label="elemento.nombre_proveedor" :value="elemento"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="cargarDataProveedores">aceptar</v-btn>
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
    props:['productor', 'proveedores'],
    data(){
        return{
            botonOtro:false,
            provAprobados:[],
            botonProveedor:false, 
            provDialog : false,
            nombre_prov: '',
            proveedor:'',
            productos:[],
            c_envio:[],
            c_pago:[],
        }
    },
    watch:{
        cargarListaProveedores(){
            if(provAprobados.legnth == 0 ){
                const params = {
                    buscar : 'proveedores',
                    id : this.productor.id,
                    tipo : 'inicial'
                }
                axios.post("/contratosOpetations",params).then((response)=>{
                    this.provAprobados = response.data
                })
            }
        },
    },
    methods:{
            
        cargarDataProveedores(){
            /*
           let params = {
                    buscar : 'productos',
                    id : this.proveedor.id,
                    tipo : 'inicial'
                }
            axios.post("/contratosOpetations",params).then((response)=>{
                this.productos = response.data

                params. buscar = 'condiciones-pago'
                axios.post("/contratosOpetations",params).then((response)=>{
                this.provAprobados = response.data

                    params. buscar = 'condiciones-envio'
                    axios.post("/contratosOpetations",params).then((response)=>{
                    this.provAprobados = response.data
                    })
                })
            })


            console.log(this.proveedor)
            this.provDialog = false;*/
        }
    },
}
</script>