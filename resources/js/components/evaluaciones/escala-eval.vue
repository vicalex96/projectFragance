<template>
   <v-form v-model="valid">
     <v-container class=" offset-2">
        <v-row>
          <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="8">
                  creador escala
          </v-col>
        </v-row>
       <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  fecha de vencimiento
                  <p>(opcional)</p>
          </v-col>
          <v-col class="blue lighten-5" cols="4" >
              <v-menu
              ref="menu1"
              v-model="menu1"
              :close-on-content-click="false"
              offset-y
              max-width="200px"
              min-width="300px"
              >
              <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="dateFormatted"
                label="fecha"
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
          
          <v-col class="blue lighten-5" cols="2" >
            <v-switch  class="mx-2" label="sin vencimiento"></v-switch>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="blue darken-2 white--text text-right pa-7" cols="2">
                  Rango de la escala
          </v-col>
          <v-col class="blue lighten-5" cols="2" >
              <v-text-field
              :rules="reglasDePeso"
              label="inicio"
              required
              ></v-text-field>
          </v-col>
          <v-col class="blue lighten-5 text-center display-2" cols="1" >
            -
          </v-col>
          <v-col class="blue lighten-5" cols="2" >
              <v-text-field
              :rules="reglasDePeso"
              label="fin"
              required
              ></v-text-field>
          </v-col>
          <v-col class="blue lighten-5" cols="1" > </v-col>
       </v-row>
       <v-row>
          <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
          </v-col>
          <v-col class="blue lighten-4" cols="6" >
              <v-btn
              :disabled="valid"
              color="success"
              class="mr-4"
              @click="validate"
              >
              crear escala
              </v-btn>  
          </v-col>
        </v-row>
      </v-container>
    </v-form>
</template>

<script>
export default {
    data: vm => ({
        fecha: new Date().toISOString().substr(0, 10),
        dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
        menu1: false,
        deactive:true,
        valid:false,
        reglasDePeso: [
                v => !!v || 'el peso es requerido', 
                v => (v && parseInt(v)<=100) || 'el peso supera el 100% o es texto',
            ],
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
        formatDate (fecha) {
            if (!fecha) return null

        const [anio, mes, dia] = fecha.split('-')
        return `${dia}-${mes}-${anio}`
        },
        validate(){

        },
    },
}
</script>
