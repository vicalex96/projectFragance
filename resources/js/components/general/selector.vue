<template>
<v-container>
    <v-row>
        <v-col class="blue lighten-2 white--text text-center display-1 pa-3" cols="6">
          {{tipo}}
        </v-col>
    </v-row>
    <v-row v-for="element in lista" :key="element[0]">
        <v-col class="blue lighten-5" cols="1" >
            <v-list-item-avatar >
                <v-avatar
                color="#2196F3"
                size="56"
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
        <v-col class="blue lighten-5" cols="2" >    
  
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
        <v-col class="blue lighten-2 white--text text-center pa-3"  cols="6">
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
        names: ['Oliver', 'Jake', 'Noah', 'James', 'Jack', 'Connor', 'Liam', 'John', 'Harry', 'Callum', 'Mason', 'Robert', 'Jacob', 'Jacob', 'Jacob', 'Michael', 'Charlie', 'Kyle', 'William', 'William', 'Thomas', 'Joe', 'Ethan', 'David', 'George', 'Reece', 'Michael', 'Richard', 'Oscar', 'Rhys', 'Alexander', 'Joseph', 'James', 'Charlie', 'James', 'Charles', 'William', 'Damian', 'Daniel', 'Thomas', 'Amelia', 'Margaret', 'Emma', 'Mary', 'Olivia', 'Samantha', 'Olivia', 'Patricia', 'Isla', 'Bethany'],
        surnames: ['Smith', 'Anderson', 'Clark', 'Wright', 'Mitchell', 'Johnson', 'Thomas', 'Rodriguez', 'Lopez', 'Perez', 'Williams', 'Jackson', 'Lewis', 'Hill', 'Roberts', 'Jones', 'White', 'Lee', 'Scott', 'Turner', 'Brown', 'Harris', 'Walker', 'Green', 'Phillips', 'Davis', 'Martin', 'Hall', 'Adams', 'Campbell', 'Miller', 'Thompson', 'Allen', 'Baker', 'Parker', 'Wilson', 'Garcia', 'Young', 'Gonzalez', 'Evans', 'Moore', 'Martinez', 'Hernandez', 'Nelson', 'Edwards', 'Taylor', 'Robinson', 'King', 'Carter', 'Collins'],
        }
    },

    computed: {
        items () {
            const namesLength = this.item.length
            const colorsLength = this.colors.length

            return Array.from({ length: 10000 }, (k, v) => {
                const name = this.names[this.genRandomIndex(namesLength)]
                const surname = this.surnames[this.genRandomIndex(surnamesLength)]

            return {
                color: this.colors[this.genRandomIndex(colorsLength)],
                fullName: `${name} ${surname}`,
                initials: `${name[0]} ${surname[0]}`,
                }
            })
        },
    },

    methods: {
        genRandomIndex (length) {
            return Math.ceil(Math.random() * (length - 1))
        },
        loadData(datosObtenidos){
            this.nombre = datosObtenidos.fullName
        },
        seleccionar(elemento){
            this.$emit('elementSelect',elemento)
        }
    },
}
</script>
