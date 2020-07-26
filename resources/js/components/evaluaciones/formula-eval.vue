<template>
    <v-container fluid>
        <v-form ref="form" v-model="dataFormula.valid">
            <v-row class="justify-center">
                <v-col
                    class="blue lighten-2 white--text text-center display-2 pa-3"
                    cols="12"
                >
                    creacion de formulas
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    class="blue darken-2 text-right white--text pa-5"
                    cols="2"
                >
                    tipo de formula
                </v-col>
                <v-col class="blue lighten-5" cols="1"></v-col>
                <v-col class="blue lighten-5" cols="9">
                    <v-radio-group v-model="tipoEval" row>
                        <v-radio label="inicial" value="inicial"></v-radio>
                        <v-radio
                            label="renovacion"
                            value="renovacion"
                        ></v-radio>
                    </v-radio-group>
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    class="blue darken-2 white--text text-right pa-5"
                    cols="2"
                >
                    agregar criterio
                </v-col>
                <v-col
                    class="blue lighten-4 white--text text-left pa-3"
                    align="center"
                    cols="10"
                >
                    <v-btn
                        color="success"
                        class="mx-2"
                        @click="agregarCriterio"
                        dark
                    >
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>

            <v-row v-for="criterio in criterios" :key="criterio.id">
                <v-col
                    class="blue darken-2 white--text text-right pa-7"
                    cols="2"
                >
                    criterio: {{ criterio.id }}
                </v-col>
                <v-col class="blue lighten-5" cols="6">
                    <v-select
                        v-model="criterio.id_variable"
                        :items="varaiblesFiltradas"
                        item-value="id_variable"
                        item-text="nombre"
                        :rules="reglasDelista"
                        label="elige criterio"
                        required
                    >
                    </v-select>
                </v-col>
                <v-col class="blue lighten-5" cols="3">
                    <v-text-field
                        v-model="criterio.peso"
                        :maxlength="3"
                        :rules="reglasDePeso"
                        label="peso"
                        suffix="%"
                        required
                        >0</v-text-field
                    >
                </v-col>
                <v-col class="blue lighten-3 text-center " cols="1">
                    <v-btn
                        color="error"
                        class="mx-2"
                        dark
                        small
                        @click="eliminarCriterio(criterio.id)"
                    >
                        <v-icon dark>mdi-minus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    class="blue darken-2 text-right white--text pa-7"
                    cols="2"
                >
                    criterio exito
                </v-col>
                <v-col class="blue lighten-4" cols="2">
                    <v-text-field
                        v-model="pesoExito"
                        :counter="3"
                        :rules="reglasDePeso"
                        label="peso"
                        suffix="%"
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="blue lighten-4" cols="8"> </v-col>
            </v-row>

            <v-row>
                <v-col
                    class="blue darken-2 white--text text-right pa-5"
                    cols="2"
                >
                </v-col>
                <v-col class="blue lighten-3 text-right" cols="10">
                    <v-btn
                        :disabled="!dataFormula.valid"
                        color="success"
                        class="mr-4"
                        @click="crearFormula"
                    >
                        crear formula
                    </v-btn>
                </v-col>
            </v-row>

            <v-dialog v-model="dataFormula.dialog" max-width="400">
                <v-card>
                    <v-card-title class="headline">{{
                        dataFormula.mensaje
                    }}</v-card-title>

                    <v-card-text>
                        {{ dataFormula.descripcion }}
                        <v-icon
                            class="pa-3"
                            color="green"
                            v-if="dataFormula.status == 1"
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
                            @click="guardarFormula"
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
    props: ["productor", "variables"],
    data() {
        return {
            tipoEval: "inicial",
            criterios: [],
            reglasDePeso: [
                v => !!v || "el peso es requerido",
                v => /^[0-9]{0,3}$/.test(v) || "solo numeros",
                v =>
                    (v && parseInt(v) <= 100) ||
                    "el peso supera el 100% o es texto"
            ],
            reglasDelista: [v => !!v || "criterio es necesario"],
            pesoExito: "",
            dataFormula: {
                mensaje: "",
                descripcion: "",
                dialog: false,
                valid: false,
                status: 0
            },
            formulasPrevias: ""
        };
    },
    computed: {
        varaiblesFiltradas() {
            let objeto = [];
            let vari = "";
            for (vari in this.variables) {
                if (
                    this.variables[vari].nombre
                        .toLowerCase()
                        .indexOf("exito") == -1
                ) {
                    objeto.push(this.variables[vari]);
                }
            }
            return objeto;
        },
        buscarCriterioExito() {
            let objeto = [];
            let vari = "";
            for (vari in this.variables) {
                if (
                    this.variables[vari].nombre
                        .toLowerCase()
                        .indexOf("exito") >= 0
                ) {
                    return this.variables[vari];
                }
            }
        },
        revisarFormulasExistentes() {
            axios
                .get("/evaluaciones/formulas", this.productor)
                .then(response => {
                    this.variablesFormula = response.data;
                });
        }
    },
    methods: {
        validate() {
            this.$refs.form.validate();
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        agregarCriterio() {
            const criterio = {
                id: this.criterios.length,

                peso: 0
            };

            this.criterios.push(criterio);
        },
        guardarCriterioExito(value) {
            const criterio = {
                id: this.criterios.length,
                id_variable: this.buscarCriterioExito.id_variable,
                peso: value
            };

            this.criterios.push(criterio);
        },
        eliminarCriterio(index) {
            this.criterios.splice(index, 1);
            this.contador = 0;
            for (this.e in this.criterios) {
                this.criterios[this.contador].id = this.contador;
                this.contador++;
            }
        },
        elegirTipoEval() {
            alert(value);
            if (this.tipoEval == "inicial") {
                this.tipoEval = "renovacion";
            } else {
                this.tipoEval = "inicial";
            }
        },
        crearFormula() {
            let resultado = this.comprobarData();
            switch (resultado) {
                case 1:
                    this.dataFormula.mensaje =
                        "La formula se ha creado correctamente";
                    this.dataFormula.descripcion =
                        "todos los datos se han guardado";
                    this.dataFormula.status = 1;
                    break;
                default:
                    this.eliminarCriterio(this.criterios.length - 1);
                case -1:
                    let falta = 3 - this.criterios.length;
                    this.dataFormula.mensaje = "-Error:faltan criterios-";
                    this.dataFormula.descripcion =
                        "las formulas para evaluaciones iniciales requieren 3 " +
                        "criterios como minimo, sin incluir criterio de exito, falta " +
                        falta +
                        " criterios por agregar";
                    this.dataFormula.status = -1;
                    break;
                case -2:
                    falta = 1 - this.criterios.length;
                    this.dataFormula.mensaje = "- Error: faltan criterios -";
                    this.dataFormula.descripcion =
                        "las formulas para renovaciones requieren 1 " +
                        "criterios como minimo, sin incluir criterio de exito, falta " +
                        falta +
                        " criterios por agregar";
                    this.dataFormula.status = -2;
                    break;
                case -3:
                    this.dataFormula.mensaje =
                        "-Error: falta rellenar el criterio de exito -";
                    this.dataFormula.descripcion =
                        "este criterio permite saber la nota minima para pasar la evalucion";
                    this.dataFormula.status = -3;
                    break;
                case -4:
                    this.dataFormula.mensaje = "- Error: criterios repetidos -";
                    this.dataFormula.descripcion =
                        "no deben repetirse los criterios";
                    this.dataFormula.status = -4;
                    break;
                case -5:
                    this.dataFormula.mensaje =
                        "- Error: el peso total excede el 100% -";
                    this.dataFormula.descripcion =
                        "la suma de los pesos de criterios, sin contar el de exito, deben dar 100%";
                    this.dataFormula.status = -5;
                    break;
                case -6:
                    this.dataFormula.mensaje =
                        "- Error:el peso total no alcansa el 100% -";
                    this.dataFormula.descripcion =
                        "la suma de los pesos de criterios, sin contar el de exito, deben dar 100%";
                    this.dataFormula.status = -6;
                    break;
                case -7:
                    this.dataFormula.mensaje =
                        "- Error:falta el criterio de exito -";
                    this.dataFormula.descripcion =
                        "es necesario indicar el criterio de exito";
                    this.dataFormula.status = -7;
                    break;
            }
            this.dataFormula.dialog = true;
        },
        comprobarData() {
            let id = "";
            var pesoTotal = 0;
            if (this.tipoEval == "inicial" && this.criterios.length < 3) {
                return -1;
            }
            if (this.tipoEval == "renovacion" && this.criterios.length < 1) {
                return -2;
            }
            pesoTotal = 0;
            for (id in this.criterios) {
                if (this.criterios[id].peso <= 0) return -3;
                if (id <= this.criterios.length - 1) {
                    pesoTotal = pesoTotal + parseInt(this.criterios[id].peso);
                }
                let id2 = 0;
                for (id2 in this.criterios) {
                    if (
                        this.criterios[id].id_variable ==
                            this.criterios[id2].id_variable &&
                        id != id2
                    ) {
                        return -4;
                    }
                }
            }
            if (pesoTotal > 100) return -5;
            if (pesoTotal < 100) return -6;
            if (this.pesoExito <= 0 || this.pesoExito > 100) {
                return -7;
            }
            return 1;
        },
        guardarFormula() {
            this.guardarCriterioExito(this.pesoExito);
            const formula = {
                criterios: this.criterios,
                tipoEval: this.tipoEval,
                id_productor: this.productor.id_productor
            };
            axios
                .post("/evaluaciones/crear-formula", formula)
                .then(response => {
                    console.log(response.data);
                });
            this.dataFormula.dialog = false;
            this.$emit("regresarAtras", true);
        },
        cancelarFormula() {
            this.$emit("regresarAtras", false);
        }
    }
};
</script>
