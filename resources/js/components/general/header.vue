<template>

    <v-card
      color="grey lighten-4"
      flat
      height="250px"
      tile
    >
    <v-card color="blue lighten-2">
      <v-card-title class="text-center justify-center py-10">
        <h1 class="font-weight-bold display-3 white--text">Mundo Perfume</h1>
      </v-card-title>
  
      <v-tabs
        v-model="tab"
        background-color="transparent"
        color="basil"
        grow
      >
        <v-tab color="blue lighten-2"
          v-for="item in items"
          :key="item"
          @click="redireccionar(item)"
        >
           <p class=" white--text">{{ item }} </p>
          
        </v-tab>
      </v-tabs>
  
      <v-tabs-items v-model="tab">
        <v-tab-item
          v-for="item in items"
          :key="item"
          
        >
          <v-card
            color="cyan"
            flat
          >
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
    </v-card>

</template>

<script>

export default {
  name:"ExampleComponent",
  data () {
    return {
      tab:null,
      items: [
        'inicio', 'Recomendador', 'evaluaciones', 'contratos','pedidos',
      ],
    }
  },
  methods:{
    redireccionar(item){
      if(item=='inicio') window.location.href = '/inicio'
      if(item=='Recomendador') window.location.href = '/recomendador'
      if(item=='evaluaciones') window.location.href = '/evaluaciones'
      if(item=='contratos') window.location.href = '/gestionContrato'
      if(item=='pedidos') window.location.href = '/pedidos'
    
      
    }
  },
  mounted(){

  },
}
</script>




