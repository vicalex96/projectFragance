<template>
    <v-container>
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="8">
                opciones de formulas y evaluaciones 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue lighten-2 white--text text-right " cols="8">
                productor: -- {{productor.nombre}} --
            </v-col>
        </v-row>
        
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  Escalas
            </v-col>
            <v-col class="blue lighten-5" cols="6" >
                <v-btn
                color="warning"
                class="mr-4"
                @click="crearEscala"
                >
                crear escala
                </v-btn> 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                formulas
            </v-col>
            <v-col class="blue lighten-4" cols="6" >
                <v-btn
                color="warning"
                class="mr-4"
                @click="crearFormula"
                >
                crear formula
                </v-btn> 
            </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                evaluar
            </v-col>
            <v-col class="blue lighten-5" cols="6" >
                <v-btn
                color="success"
                class="mr-4"
                @click="ejecutarEvaluacion"
                >
                ejecutar evaluacion
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
        crearFormula(){
            this.$emit('opcionFormula','formula')
        },
        crearEscala(){
            this.$emit('opcionFormula','escala')
        },
        ejecutarEvaluacion(){
            this.$emit('opcionEvaluacion','evaluacion')
        }
    },
    updated(){
        this.valid = true
    },
}
</script>
