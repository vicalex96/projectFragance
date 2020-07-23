<template>
      <v-form>
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
            <v-col class="blue lighten-5" cols="1" > {{tipoEval}} </v-col>
            <v-col class="blue lighten-5" cols="9">
                    <v-radio-group :v-model="tipoEval" :mandatory="true" @click="elegirTipoEval" row>
                      <v-radio label="inicial"    value='inicial'></v-radio>
                      <v-radio label="renovacion" value='renovacion'></v-radio>
                    </v-radio-group> 
           </v-col>
        </v-row>
       
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  criterios
          </v-col>
          <v-col class="blue lighten-4 text-center pa-5" cols="2" >
              agregar criterio
         </v-col>
            <v-col class="blue lighten-4 white--text text-right pa-3" cols="1">
                <v-btn
                color="success"
                class="mr-4"
                @click="agregarCriterio"
                >
                +
                </v-btn>
            </v-col>
            <v-col class="blue lighten-4 white--text text-right pa-3" cols="7"></v-col>
       </v-row>
        <v-row v-for="criterio in criterios" :key="criterio.nro" >
          <v-col class="blue darken-2 white--text text-right pa-7" cols="2">
                  criterio: {{criterio.nro}}
          </v-col>
          <v-col class="blue lighten-5" cols="7" >
              <v-select
              v-model="criterio.select"
              :items="items"
              :rules="[v => !!v || 'criterio es necesario']"
              label="elige criterio"
              required
              ></v-select>
          </v-col>
          <v-col class="blue lighten-5" cols="2" >
              <v-text-field
              v-model="criterio.peso"
              :maxlength="3"
              :rules="reglasDePeso"
              label="peso"
              suffix="%"
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
      
       <v-row v-if="tipoEval=='renovacion'">
          <v-col  class="blue darken-2 text-right white--text pa-7" cols="2">
            criterio exito 
          </v-col>
          <v-col class="blue lighten-4" cols="2">
              <v-text-field
              v-model="pesoExito"
              :counter="3"
              :rules="reglasDePeso"
              label="peso"
              suffix="%"
              required
              ></v-text-field>            
          </v-col>
          <v-col class="blue lighten-4" cols="8">
            <checkbox></checkbox>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
          </v-col>
          <v-col class="blue lighten-3" cols="10" >
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
    </v-form>
</template>

<script>
export default {
    data(){
        return{
            tipoEval:'inicial',
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
            peso:'',
            select:null,
            }],
            reglasDePeso: [
                v => !!v || 'el peso es requerido', 
                v => (/^[0-9]{0,3}$/.test(v)|| 'solo numeros'),
                v => (v && parseInt(v)<=100) || 'el peso supera el 100% o es texto',   
            ],

            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4',
            ],
            valid: true
      }
  },
 /*   data: () => ({
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
      select:null,
    }],


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
    disabled:true,
    contador: 0,
    e:0,
    tipoEval:'inicial',


  }),*/

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
        const criterio = {
        nro: this.criterios.length,
        id: this.criterios.length,
        descripcion:'',
        peso: 0,
        }

        this.criterios.push(criterio)
    },
    eliminarCriterio(index){
      this.criterios.splice(index,1)
      this.contador = 0
      for(this.e in this.criterios){
        this.criterios[this.contador].nro = this.contador
        this.contador++    
      }
      
    },
    elegirTipoEval(){
        alert(value)
        if(this.tipoEval == 'inicial'){
            this.tipoEval = 'renovacion'
        }else{
            this.tipoEval = 'inicial'
        }
    }
  },
}
</script>
