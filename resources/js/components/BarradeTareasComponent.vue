<template>
  
    <v-app-bar
      absolute
      color="#6A76AB"
      dark
      prominent
      src="https://picsum.photos/1920/1080?random"

    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <template v-slot:extension>
        <v-tabs align-with-title>
          <v-tab href="/productores">productores</v-tab>
          <v-tab>Tab 2</v-tab>
          <v-tab>Tab 3</v-tab>
        </v-tabs>
      </template> 
       
    </v-app-bar>
 
    
   
 
    
 
</template>