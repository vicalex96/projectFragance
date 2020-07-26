<template>
    <v-container fluid>
        <opciones-formula-component
            :productor="productor"
            v-show="productor.length != 0 && opcion == 'menu'"
            @opcionElegida="elegirOpcion(...arguments)"
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
            @regresarPantalla="regresarPantalla(...arguments)"
        ></formula-component>

        <evaluar-proveedores
            v-show="opcion == 'evaluacion'"
            :productor="productor"
        ></evaluar-proveedores>

        <selector-component
            v-show="productor.length == 0"
            :lista="lista"
            :tipo="tipo"
            @elementSelect="selecionarProveedor(...arguments)"
        ></selector-component>
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
        obtenerFormulario() {
            axios
                .post(
                    "/evaluaciones/formularios-vigentes",
                    this.productor.id_productor
                )
                .then(response => {
                    this.formulas = response.data;

                });
        },
        regresarPantalla(pantalla) {
            if (pantalla == "menu") {
                this.opcion = pantalla;
            }
        }
    }
};
</script>
