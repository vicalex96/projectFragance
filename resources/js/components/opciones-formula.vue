<template>
    <v-container class=" offset-2">
        <v-row>
            <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="8">
                  opciones de formula ({{productor.nombre}})
            </v-col>
        </v-row>
         <v-row>
          <v-col class="blue darken-2 white--text text-right pa-7" cols="2">
                  Escalas
          </v-col>
          <v-col class="blue lighten-5" cols="6" >
              <v-btn
              :disabled="!valid"
              color="warning"
              class="mr-4"
              @click="crearEscala"
              >
              crear escala
              </v-btn> 
          </v-col>
       </v-row>
                <v-row>
          <v-col class="blue darken-2 white--text text-right pa-7" cols="2">
                formulas
          </v-col>
          <v-col class="blue lighten-4" cols="6" >
              <v-btn
              :disabled="!valid"
              color="warning"
              class="mr-4"
              @click="crearFormula"
              >
              crear formula
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
    data:()=>({
        valid: false, 
    }),
    methods:{
        crearFormula(){
            this.$emit('opcionFormula','formula')
        },
        crearEscala(){
            this.$emit('opcionFormula','escala')
        }
    },
    updated(){
        this.valid = true
    },
}
</script>
