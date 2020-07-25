<template>
  <v-card
    color="grey lighten-4"
    flat
    height="200px"
    tile
  >
    <v-toolbar prominent extended>


      <v-toolbar-title >VAM-PRODUCTIONS</v-toolbar-title>

      <v-spacer></v-spacer>

        <template v-slot:extension>
          <v-tabs align-with-title>
          <v-tab>Tab 1</v-tab>
          <v-tab>Tab 2</v-tab>
          <v-tab>Tab 3</v-tab>
          </v-tabs>
        </template>

    </v-toolbar>

    <cardlist-component/>
  </v-card>

</template>