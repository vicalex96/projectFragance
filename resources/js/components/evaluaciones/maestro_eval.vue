<template>
    <v-container fluid>
        <selector-component
            v-show="productor.length == 0"
            :lista="lista"
            :tipo="tipo"
            @elementSelect="selecionarProveedor(...arguments)"
        ></selector-component>

        <opciones-formula-component
            :productor="productor"
            v-show="productor.length != 0 && opcion == 'menu'"
            @opcionElegida="elegirOpcion(...arguments)"
            @regresarPantalla="regresarPantalla(...arguments)"
            
            
        >
        </opciones-formula-component>

        <escala-component
            v-show="opcion == 'escala'"
            :productor="productor"
            @regresarPantalla="regresarPantalla(...arguments)"
        ></escala-component>

        <formula-component
            v-show="opcion == 'formula'"
            :productor="productor"
            :variables="variablesFormula"
            :formulas="formulas"
            @regresarPantalla="regresarPantalla(...arguments)"
        ></formula-component>

        <evaluar-proveedores
            v-show="opcion == 'evaluacion'"
            :productor="productor"
            :formulas="formulas"
        ></evaluar-proveedores>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            variablesFormula: [],
            tipo: "productores",
            lista: [],
            productor: [],
            escalaView: false,
            opcion: "menu",
            formulas: []
        };
    },
    mounted() {
        axios.get("/productores").then(response => {
            this.lista = response.data;
        });
    },
    methods: {
        elegirOpcion(opcion) {
            this.opcion = opcion;
            if (opcion == "formula") {
                this.obtenerVariables();
                this.obtenerFormulas();
            }
            if (opcion == "evaluacion") {
                this.obtenerFormulas();
            }
        },
        agregarComentario(comentario) {
            axios.get("/familia").then(response => {
                this.lista = response.data;
            });
        },
        eliminaComentario(index) {
            this.comentarios.splice(index, 1);
        },
        selecionarProveedor(elemento) {
            this.productor = elemento;
        },
        obtenerVariables() {
            axios.get("/evaluaciones/variables").then(response => {
                this.variablesFormula = response.data;
            });
        },
        obtenerFormulas() {
            axios
                .post(
                    "/evaluaciones/formularios-vigentes",
                    this.productor
                )
                .then(response => {
                    this.formulas = response.data;
                });
        },
        regresarPantalla(pantalla) {
            if (pantalla == "seleccion") {
                productor = "";
            }
            this.opcion = pantalla;
        }
    }
};
</script>
