<template>
    <v-container >
      <v-form
        ref="form"
        v-model="valid"
        :lazy-validation="lazy" 
        class="pa-5"
        >      
          <v-row warp mt-5 justify-center no-gutters>
              <v-col class="blue lighten-2 white--text text-center display-2 pa-3" cols="12">
                  Recomendador
             </v-col>
    
              <v-col class="blue darken-2 text-right white--text pa-5" cols="2">
                Genero   
              </v-col>
              <v-col class="blue lighten-5" cols="10">
                    <v-radio-group row>
                      <v-col  cols="1" > </v-col>
                      <v-radio label="masculino" value="radio-1"></v-radio>
                      <v-radio label="femenino" value="radio-2"></v-radio>
                      <v-radio label="unisex" value="radio-3"></v-radio>
                    </v-radio-group> 
              </v-col>
              
              <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  intensidad
              </v-col>
              <v-col class="blue lighten-4" cols="10" >
                  <v-radio-group  row >
                  <v-col  cols="1" > </v-col>
                  <v-radio label="adulto" value="radio-1"></v-radio>
                  <v-radio label="juvenil" value="radio-2"></v-radio>
                  <v-radio label="atemporal" value="radio-3"></v-radio>
                  <v-radio label="infantil" value="radio-4"></v-radio>
                  </v-radio-group>   
              </v-col>
            
              <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  Caracter
               </v-col>
               <v-col class="blue lighten-5" cols="10" row>
               <v-row justify="center">
                    <v-checkbox class="mx-2" label="informal"></v-checkbox>
                    <v-checkbox class="mx-2" label="natural"></v-checkbox>
                    <v-checkbox class="mx-2" label="clásico"></v-checkbox>
                    <v-checkbox class="mx-2" label="seductor"></v-checkbox>
                    <v-checkbox class="mx-2" label="moderno"></v-checkbox>
               </v-row>
               </v-col>
            
               <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  Familia Olfativa
               </v-col>
               <v-col class="blue lighten-4"  cols="10" row>
               <v-row justify="center">
                    <v-checkbox class="mx-2" label="Verde"></v-checkbox>
                    <v-checkbox class="mx-2" label="Cítrico"></v-checkbox>
                    <v-checkbox class="mx-2" label="Flores"></v-checkbox>
                    <v-checkbox class="mx-2" label="Frutas"></v-checkbox>
                    <v-checkbox class="mx-2" label="Aromáticos"></v-checkbox>
                    <v-checkbox class="mx-2" label="Helechos"></v-checkbox>
                    <v-checkbox class="mx-2" label="Chipre"></v-checkbox>
                    <v-checkbox class="mx-2" label="Maderas"></v-checkbox>
                    <v-checkbox class="mx-2" label="Orientales"></v-checkbox>
                    <v-checkbox class="mx-2" label="Otros"></v-checkbox>
               </v-row>
               </v-col>

              <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  Aromas destacados
               </v-col>
              <v-col class="blue lighten-5" cols="10" row>
               <v-row justify="center">
                    <v-checkbox class="mx-3" label="floral"></v-checkbox>
                    <v-checkbox class="mx-3" label="frutal"></v-checkbox>
                    <v-checkbox class="mx-3" label="herbal"></v-checkbox>
                    <v-checkbox class="mx-3" label="cítrico"></v-checkbox>
                    <v-checkbox class="mx-3" label="herbal aromático"></v-checkbox>
                    <v-checkbox class="mx-3" label="amaderado"></v-checkbox>
                    <v-checkbox class="mx-3" label="café"></v-checkbox>
                    <v-checkbox class="mx-3" label="chocolate"></v-checkbox>
                    <v-checkbox class="mx-3" label="vainilla"></v-checkbox>
                    <v-checkbox class="mx-3" label="especias"></v-checkbox>
                    <v-checkbox class="mx-3" label="tabaco"></v-checkbox>
                    <v-checkbox class="mx-3" label="otros "></v-checkbox>
               </v-row>
               </v-col>
          
              <v-col class="blue darken-2 white--text text-right pa-5" cols="2" >
                  Ocacion
              </v-col>
              <v-col class="blue lighten-4 white--text text-right"  cols="10">
                    <v-radio-group  row>
                      <v-col  cols="1" > </v-col>
                      <v-radio label="Diario" value="radio-1"></v-radio>
                      <v-radio label="trabajo" value="radio-2"></v-radio>
                      <v-radio label="especial" value="radio-3"></v-radio>
                      </v-radio-group>
              </v-col>
            
              <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
                  enfocado para
              </v-col>
              <v-col class="blue lighten-5" cols="10" row>
               <v-row justify="center">
                    <v-checkbox class="mx-3" label="libertad"></v-checkbox>
                    <v-checkbox class="mx-3" label="independencia"></v-checkbox>
                    <v-checkbox class="mx-3" label="creatividad"></v-checkbox>
                    <v-checkbox class="mx-3" label="creatividad"></v-checkbox>
                    <v-checkbox class="mx-3" label="diversión"></v-checkbox>
                    <v-checkbox class="mx-3" label="otros"></v-checkbox>
               </v-row>
               </v-col>

            
           <v-col class="blue darken-2 white--text text-right pa-5" cols="2">
           </v-col>
           <v-col  class = "blue lighten-4 pa-3 white--text text-right" cols="10">
            <v-btn
            color="error"
            class="mr-4"
            @click="reset"
            >
            Reset Form
            </v-btn>
           </v-col>
            
      </v-row> 
      </v-form>
    </v-container>
</template>

<script>
export default {
  name:"Redomendador",
  data: () => ({
    valid: true,
    name: '',
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    select: null,
    items: [
      'Item 1',
      'Item 2',
      'Item 3',
      'Item 4',
    ],
    checkbox: false,
    lazy: false,
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
  },
}
</script>