<template>
<v-container>
    <v-row>
        <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="8">
          elegir {{tipo}}
        </v-col>
    </v-row>
    <v-row v-for="(element) in lista" :key="element[0]">
        <v-col class="blue lighten-5" cols="1" >
            <v-list-item-avatar >
                <v-avatar
                :color="colors[0]"
                size="30"
                class="white--text"
                >
                {{element.nombre.charAt(0)}}
                </v-avatar>
            </v-list-item-avatar>
        </v-col>
        <v-col class="blue lighten-5" cols="3" >        
            <v-list-item-content>
                <v-list-item-title>{{ element.nombre }}</v-list-item-title>
            </v-list-item-content>
        </v-col>
        <v-col class="blue lighten-5" cols="4" >    
  
                <v-list-item-action>
                    <v-btn
                    depressed
                    small
                    @click="seleccionar(element)"
                    >
                    seleccionar
  
                        <v-icon
                        color="orange darken-4"
                        right
                        >
                        mdi-open-in-new
                        </v-icon>
                    </v-btn>
              </v-list-item-action>
        </v-col>
    </v-row>  
    <v-row>
        <v-col class="blue lighten-2 white--text text-center pa-3"  cols="8">
        </v-col>
    </v-row>        
    </v-container>
</template>

<script>
export default {
    props:['tipo','lista'],
    data(){
        return{
        nombre:"selector productor", 
        colors: ['#2196F3', '#90CAF9', '#64B5F6', '#42A5F5', '#1E88E5', '#1976D2', '#1565C0', '#0D47A1', '#82B1FF', '#448AFF', '#2979FF', '#2962FF'],
        }
    },

    methods: {
        seleccionar(elemento){
            this.$emit('elementSelect',elemento)
        }
    },
}
</script>
