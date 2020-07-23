<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="8">
                Creacion y renovacion de contratos
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-right " cols="8">
                productor: -- {{productor.nombre}} --
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  nuevo contrato
            </v-col>
            <v-col class="blue lighten-5" cols="6" >
                <v-btn
                color="warning"
                class="mr-4"
                @click="seleccionar('inicial')"
                >
                crear un contrato
                </v-btn> 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                renovaciones
            </v-col>
            <v-col class="blue lighten-4" cols="6" >
                <v-btn
                color="warning"
                class="mr-4"
                @click="seleccionar('renovacion')"
                >
                renovar contrato
                </v-btn> 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center pa-3" cols="8">
            </v-col>
        </v-row>
        
    </v-container>
</template>

<script>
export default {
    props:['productor'],
    data(){
        return{

        }      
    },
    methods:{
        seleccionar(tipoEval){
            this.$emit('abrirVentana',tipoEval)
        }
    },
    updated(){
        this.valid = true
    },
}
</script>
