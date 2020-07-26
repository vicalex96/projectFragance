<template>
    <v-container fluid>
        <v-form ref="form" v-model="dataEscala.valid">
            <v-row class="justify-center">
                <v-col
                    class="blue lighten-2 white--text text-center display-1 pa-3"
                    cols="8"
                >
                    creador escala
                </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col
                    class="blue lighten-2 white--text text-left "
                    cols="8"
                >
                    productor: --{{productor.nombre}}--
                </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col
                    class="blue darken-2 white--text text-right pa-7"
                    cols="2"
                >
                    Rango de la escala
                </v-col>
                <v-col class="blue lighten-5" cols="2">
                    <v-text-field
                        v-model="dataEscala.inicio"
                        :rules="reglasDePeso"
                        label="inicio"
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="blue lighten-5 text-center display-2" cols="1">
                    -
                </v-col>
                <v-col class="blue lighten-5" cols="2">
                    <v-text-field
                        v-model="dataEscala.final"
                        :rules="reglasDePeso"
                        label="fin"
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="blue lighten-5" cols="1"> </v-col>
            </v-row>
            <v-row class="justify-center">
                <v-col
                    class="blue darken-2 white--text text-right pa-5"
                    cols="2"
                >
                </v-col>
                <v-col class="blue lighten-3 text-right" cols="6">
                    <v-btn
                        :disabled="!dataEscala.valid"
                        color="success"
                        class="mr-4"
                        @click="crearEscala"
                    >
                        crear formula
                    </v-btn>
                </v-col>
            </v-row>

            <v-dialog v-model="dataEscala.dialog" max-width="400">
                <v-card>
                    <v-card-title class="headline">{{
                        dataEscala.mensaje
                    }}</v-card-title>

                    <v-card-text>
                        {{ dataEscala.descripcion }}
                        <v-icon
                            class="pa-3"
                            color="green"
                            v-if="dataEscala.status == 1"
                            dark
                            large
                            >mdi-thumb-up</v-icon
                        >
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="green darken-1"
                            text
                            @click="dataEscala.dialog = false"
                        >
                            aceptar
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-form>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    props: ["productor"],
    data() {
        return {
            reglasDePeso: [
                v => !!v || "la escala es requerida",
                v =>
                    (v && parseInt(v) <= 10000) ||
                    "no es recomendable una escala tan alta",
                v => /^[0-9]{0,9}$/.test(v) || "solo numeros"
            ],
            dataEscala: {
                mensaje: "",
                descripcion: "",
                inicio: 0,
                final: 0,
                valid: false,
                dialog: false,
                status: 0
            },
            escalat:'',
        };
    },

    computed: {},

    watch: {},

    methods: {
        crearEscala() {
            let resultado = this.comprobarData();
            switch (resultado) {
                case 1:
                    this.guardarEscala()
                    break;
                case -1:
                    this.dataEscala.mensaje =
                        "-Error: el campo inicial es mayor-";
                    this.dataEscala.descripcion =
                        "el valor de inicio debe ser menor al valor final de la escala";
                    this.dataEscala.status = -1;
                    this.dataEscala.dialog = true;
                    break;
            }   
        },
        comprobarData() {
            if (this.dataEscala.inicio >= this.dataEscala.final) {
                return -1;
            }
            return 1;
        },
        guardarEscala() {
            this.dataEscala.dialog = false;
            const escala = {
                id_productor: this.productor.id_productor,
                rango_inicio: this.dataEscala.inicio,
                rango_final: this.dataEscala.final
            };
            axios
                .post("/evaluaciones/crear-escala", escala)
                .then(response => {
                    this.escalat = response.data
                    console.log(this.escalat)
                    this.dataEscala.mensaje =
                        "Escala creada correctamente";
                    this.dataEscala.descripcion =
                        "informacion guardada";
                    this.dataEscala.dialog = true;
                    this.dataEscala.status = 1;
                })
                .catch(error => {
                    this.dataEscala.mensaje =
                        "-Error: no fue posible guardar los datos";
                    this.dataEscala.descripcion =
                        "hubo un error al tratar de guardar los datos";
                    this.dataEscala.status = -2;
                    this.dataEscala.dialog = true;
                });
        }
    }
};
</script>
