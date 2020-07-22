<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="12">
                realizar evaluacion 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-right " cols="12">
                productor: -- {{productor.nombre}} --
            </v-col>
        </v-row>
                <v-row>
            <v-col class="blue darken-2 text-right white--text pa-5" cols="3">
                tipo de evaluacion   
            </v-col>
            <v-col class="blue lighten-5" cols="1" > {{tipoEval}} </v-col>
            <v-col class="blue lighten-5" cols="8">
                    <v-radio-group :v-model="tipoEval" :mandatory="true" @change="elegirTipoEval" row>
                      <v-radio label="inicial"    value='inicial'></v-radio>
                      <v-radio label="renovacion" value='renovacion'></v-radio>
                    </v-radio-group> 
           </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="3">
                  proveedores
            </v-col>
            <v-col class="blue lighten-5" cols="9" >
                <v-btn
                color="warning"
                class="mr-4"
                @click="mostrarListado"
                >
                crear escala
                </v-btn> 
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    props:['productor'],
    data(){
        return{
            tipoEval:"inicial",
        }
    },
    methods:{
        elegirTipoEval(){
            if(tipoEval=="inicial"){
                tipoEval == "renovacion"
            }else{
                tipoEval == "inicial"
            }
        }
    },
}
</script>