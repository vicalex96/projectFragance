<template>
  <v-card
    class="mx-auto"
    max-width="300"
    tile
  >
    <v-list>
      <v-subheader>PRODUCTORES</v-subheader>
      <v-list-item-group >
        <v-list-item
          v-for="(vam_productor, index) in vam_productores " :key="index">
          <v-list-item-content>
            <v-list-item-title v-text="vam_productor.nombre"></v-list-item-title>
            <v-list-item-title v-text="vam_productor.correo"></v-list-item-title>
            <v-list-item-title v-text="vam_productor.pagina"></v-list-item-title>
            <v-btn small>Button</v-btn>
            <v-btn small>Button</v-btn>
          </v-list-item-content>
 
                
                

        </v-list-item>

      </v-list-item-group>
    </v-list>
  </v-card>
</template>

<script>
import axios from 'axios'
  export default {
    data: () => ({
      //vam_productor: 1,
      vam_productores: [],
    }),

    created(){/*ver productores*/
     axios.get('/productores').then(res => {
      this.vam_productores = res.data;
        })
    },
  }
</script>

<style>

</style>