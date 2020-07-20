<template>
    <v-container>
        <v-row>
          <v-col class="blue lighten-2 white--text text-center display-2 pa-3" cols="12">
                  creador de evaluaciones
          </v-col>
        </v-row>
        <v-row>
            <v-col class="blue darken-2 text-right white--text pa-5" cols="2">
                tipo de evaluacion   
            </v-col>
            <v-col class="blue lighten-5" cols="10">
                    <v-radio-group v-model="row" row>
                      <v-col  cols="1" > </v-col>
                      <v-radio label="inicial" value="radio-1"></v-radio>
                      <v-radio label="renovacion" value="radio-2"></v-radio>
                    </v-radio-group> 
           </v-col>
        </v-row>
       
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  criterios
          </v-col>
          
          <v-col class="blue lighten-4" cols="2" >
              agregar criterio
              <v-btn
               :disabled="!valid"
               color="success"
               class="mr-4"
               @click="agregarCriterio"
               >
                +
             </v-btn>
         </v-col>
          <v-col class="blue lighten-4 white--text text-right pa-3" cols="8">
       </v-row>
        <v-row v-for="criterio in criterios" :key="criterio.nro" >
          <v-col class="blue darken-2 white--text text-right pa-7" cols="2">
                  criterio: {{criterio.nro}}
          </v-col>
          <v-col class="blue lighten-5" cols="7" >
              <v-select
              v-model="criterio.select"
              :items="items"
              :rules="[v => !!v || 'Item is required']"
              label="elige criterio"
              required
              ></v-select>
          </v-col>
          <v-col class="blue lighten-5" cols="2" >
              <v-text-field
              v-model="criterio.peso"
              :counter="3"
              :rules="reglasDePeso"
              label="peso %"
              required
              ></v-text-field>
          </v-col>
          <v-col class="blue lighten-3" cols="1" >
              <v-btn
               color="error"
               class="mr-4"
               @click="eliminarCriterio(criterio.nro)"
               >
                -
             </v-btn>
         </v-col>
       </v-row>
      
       <v-row>
          <v-col class="blue darken-2 text-right white--text pa-7" cols="2">
            criterio exito 
          </v-col>
          <v-col class="blue lighten-4" cols="2">
              <v-text-field
              v-model="pesoExito"
              :counter="3"
              :rules="reglasDePeso"
              label="peso %"
              required
              ></v-text-field>            
          </v-col>
          <v-col class="blue lighten-4" cols="8">
            
          </v-col>
        </v-row>
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  criterios
          </v-col>
          <v-col class="blue lighten-5" cols="10" >
              <v-btn
              :disabled="!valid"
              color="success"
              class="mr-4"
              @click="validate"
              >
              crear evaluacion
              </v-btn>  
          </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => ({
    criterios:[{
      nro: 0,
      id: 0,
      descripcion:'',
      peso: '',
      select: null,
    },
    {
      nro: 1,
      id: 1,
      descripcion:'',
      peso: 0,
    }],
    borraCriterio: '',
    valid: true,
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    pesoExito:'',
    reglasDePeso: [
      v => !!v || 'el peso es requerido', 
      v => (v && parseInt(v)<=100) || 'el peso supera el 100% o es texto',
    ],
    select: null,
    items: [
      'Item 1',
      'Item 2',
      'Item 3',
      'Item 4',
    ],
    checkbox: false,
  }),

  methods: {
    validate () {
      this.$refs.form.validate()
    },
    reset () {
      this.$refs.form.reset()
    },
    resetValidation () {
      this.$refs.form.resetValidation()
    },
    agregarCriterio(){
      criterio = {
      nro: this.criterios.length,
      id: this.criterios.length,
      descripcion:'',
      peso: 0,
      }
      this.criterios.push(criterio)
    },
    eliminarCriterio(index){
      this.criterios.splice(index,1)
      contador = 0
      for(e in this.criterios){
        this.criterios[contador].nro = contador
        contador++    
      }
      
    },
  },
}
</script>
