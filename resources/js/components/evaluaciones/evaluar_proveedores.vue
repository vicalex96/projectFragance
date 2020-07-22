<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="12">
                realizar evaluacion 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-right " cols="6">
               <p>productor: -- {{productor.nombre}} -- </p> 
            </v-col>
            <v-col class="blue lighten-2 white--text text-right " cols="6">
                <p v-if="empresaProveedora">proveedor: -- {{empresaProveedora.nombre}} --</p> 
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
                <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="3">
                  pais
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-dialog v-model="dialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                         color="warning"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        >
                        seleccionar lugar envio
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>elegir pais</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text style="height: 400px;">
                            <v-radio-group v-model="empresaProveedora" v-for="proveedor in proveedores" :key="proveedor.id_proveedor" column>
                                <v-radio :label="proveedor.nombre" :value="proveedor"></v-radio>
                            </v-radio-group>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn color="blue darken-1" text @click="dialog = false">aceptar</v-btn>
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
                <v-dialog v-model="dialog" scrollable max-width="300px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                        :disabled="paises == null && tipoEval == null"
                         color="primary"
                        dark
                        v-bind="attrs"
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
                            <v-btn color="blue darken-1" text @click="dialog = false">aceptar</v-btn>
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
            dialog: false,
            proveedores:[],
            contenido:'vacio',
            paises:null,
        }
    },
    methods:{
        cargarPaises(Paises){

        },
        cargarLista(tipoEval){
            this.empresaProveedora= ''
            if(tipoEval== 'inicial' && this.contenido != 'inicial'){
                axios.get(`/proveedores/${this.productor.id_productor}`)
                .then((response)=>{
                    this.proveedores = response.data;
                });
            }
            if(tipoEval == 'renovacion' && this.contenido != 'renovacion'){
                axios.get("/proveedores/renovacion", this.productor)
                .then((response)=>{
                    this.proveedores = response.data
                });
                
            }
        }
    },
}
</script>