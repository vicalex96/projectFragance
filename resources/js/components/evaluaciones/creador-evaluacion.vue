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
            <checkbox></checkbox>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  fecha de vencimiento
                  <p>(opciona)</p>
          </v-col>
          <v-col class="blue lighten-5" cols="4" >
              <v-menu
              ref="menu1"
              v-model="menu1"
              :disabled="disabled"
              :close-on-content-click="false"
              offset-y
              max-width="200px"
              min-width="300px"
              >
              <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="dateFormatted"
                label="fecha"
                :disabled="disabled"
                hint="formato MM/DD/YYYY"
                persistent-hint
                prepend-icon="event"
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
              </template>
              <v-date-picker v-model="fecha" no-title @input="menu1 = false"></v-date-picker>
            </v-menu>  
          </v-col>
          
          <v-col class="blue lighten-5" cols="6" >
            <v-switch v-model="disabled" class="mx-2" label="sin vencimiento"></v-switch>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  criterios
          </v-col>
          <v-col class="blue lighten-4" cols="10" >
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
  data: vm => ({
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

    valid: true,
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
    fecha: new Date().toISOString().substr(0, 10),
    dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
    menu1: false,
    disabled:true,
  }),
  
  computed: {
    computedDateFormatted () {
      return this.formatDate(this.fecha)
    },
  },

  watch: {
    fecha (val) {
      this.dateFormatted = this.formatDate(this.fecha)
    },
  },

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
    formatDate (fecha) {
      if (!fecha) return null

      const [anio, mes, dia] = fecha.split('-')
      return `${dia}-${mes}-${anio}`
    },
  },
}
</script>
