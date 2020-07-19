<template>
  <v-card class="overflow-hidden">
    <v-app-bar
      absolute
      color="#6A76AB"
      dark
      shrink-on-scroll
      prominent
      src="https://picsum.photos/1920/1080?random"
      fade-img-on-scroll
      scroll-target="#scrolling-techniques-3"
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>MUNDO PERFUME</v-toolbar-title>

      <v-spacer></v-spacer>

      <template v-slot:extension>
        <v-tabs align-with-title>
          <v-tab> Proveedores </v-tab>
          <v-tab> Evaluacion </v-tab>
          <v-tab> Compra </v-tab>
          <v-tab> Recomendador </v-tab>
        </v-tabs>
      </template>
    </v-app-bar>

     <v-sheet
        id="scrolling-techniques-3"
        class="overflow-y-auto"
        max-height="500"
      >
        
        
      </v-sheet>
    
 
  </v-card>
  
  
</template>

<script>


</script>