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

        <v-row>
            <v-col class="blue darken-3 white--text text-right pa-5" cols="3">
                  ingredientes disponibles
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="ingredienteDialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on}">
                        <v-btn
                        :disabled="botonProveedor2"
                         color="suceess"
                        dark
                        v-on="on"
                        >
                        seleccionar ingredientes
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir ingredientes</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-radio-group v-model="productosselect" v-for="elemento in productos" :key="elemento[0]" >
                                <v-radio :label="elemento.producto_no_exclusivo" :value="elemento"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="ingredienteDialog = false">aceptar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <div v-if="productosselect != 0 " > pingredientes deseados:</div>
                <div class="blue lighten-5" v-for="elemento in productosselect" :key="elemento[0]">
                  {{elemento}},
                </div>
            </v-col>

        </v-row>

        <v-row>
            <v-col class="blue darken-3 white--text text-right pa-5" cols="3">
                  condiciones de pago
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="ingredienteDialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on}">
                        <v-btn
                        :disabled="botonProveedor2"
                         color="error"
                        dark
                        v-on="on"
                        >
                        seleccionar condiciones
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir condicion</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-checkbox 
                            
                            v-for="pago in c_pago" :key="pago[0]" v-model="c_pago_select"
                            :value = "pago.tipo_condicion">
                            </v-checkbox>

                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="pagoDialog = false">aceptar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-3 white--text text-right pa-5" cols="3">
                  condiciones de envio
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="ingredienteDialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on}">
                        <v-btn
                        :disabled="botonProveedor2"
                         color="error"
                        dark
                        v-on="on"
                        >
                        seleccionar condiciones
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir condicion</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-checkbox 
                            
                            v-for="envio in c_envio" :key="envio[0]" v-model="c_envio_select"
                            :value = "envio.medio_transporte">
                            </v-checkbox>

                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="envioDialog = false">aceptar</v-btn>
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
            botonProveedor2:true,
            botonProveedorData: true,
            provDialog : false,
            ingredienteDialog : false,
            pagoDialog: false,
            envioDialog: false,
            nombre_prov: '',
            proveedor:'',
            producto:[],
            productos:[],
            productosselect:[],
            c_envio:[],
            c_envio_select:[],
            c_pago:[],
            c_pago_select:[]
        }
    },
    methods:{
            
        cargarDataProveedores(){
            this.provDialog = false,
            this.productosselect = [],
            this.c_envio = [],
            this.c_pago=[]
           let params = {
                    buscar : 'productos',
                    id : this.proveedor.id_proveedor,
                    tipo : 'inicial'
                }
                console.log(this.proveedor.id_proveedor)
            axios.post("/contratosOpetations",params).then((response)=>{
                this.productos = response.data

                params. buscar = 'condiciones-pago'
                axios.post("/contratosOpetations",params).then((response)=>{
                    this.c_pago = response.data

                    params. buscar = 'condiciones-envio'
                    axios.post("/contratosOpetations",params).then((response)=>{
                    this.c_envio = response.data
                    })
                })

            })

            if(this.proveedor.length != 0){
                    this.botonProveedor2 = false;
        }



        }
    },
}
</script>