<template>
    <v-container>
        <v-form ref="form" v-model="dataEval.valid">
            <v-row>
                <v-col
                    class="blue lighten-2 white--text text-center display-1 pa-3"
                    cols="12"
                >
                    realizar evaluacion
                </v-col>
            </v-row>
            <v-row>
                <v-col class="blue lighten-2 white--text text-left " cols="4">
                    <p>productor: -- {{ productor.nombre }} --</p>
                </v-col>
                <v-col class="blue lighten-2 white--text text-center" cols="4">
                    <p v-if="empresaProveedora">
                        proveedor: -- {{ empresaProveedora.nombre }} --
                    </p>
                </v-col>
                <v-col class="blue lighten-2 white--text text-right" cols="4">
                    <p v-if="paisEnvios">
                        pais de preferencia: -- {{ paisEnvios.nombre }} --
                    </p>
                </v-col>
            </v-row>
            <v-row v-if ="!existeFormula && tipoEval != null ">
                <v-col class="blue lighten-2 red--text text-right display-1 " cols="12">
                        ¡no existen formulas activas para este proceso!
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    class="blue darken-2 text-right white--text pa-5"
                    cols="3"
                >
                    tipo de evaluacion
                </v-col>
                <v-col class="blue lighten-5" cols="1"> </v-col>
                <v-col class="blue lighten-5" cols="8">
                    <v-radio-group
                        v-model="tipoEval"
                        @change="cargarLista(tipoEval)"
                        row
                    >
                        <v-radio label="inicial" value="inicial"></v-radio>
                        <v-radio
                            label="renovacion"
                            value="renovacion"
                        ></v-radio>
                    </v-radio-group>
                </v-col>
            </v-row>
            <div v-if="existeFormula">
            <v-row v-if="tipoEval == 'inicial'">
                <v-col
                    class="blue darken-2 white--text text-right pa-5"
                    cols="3"
                >
                    pais
                </v-col>
                <v-col class="blue lighten-5" cols="9">
                    <v-dialog v-model="dialog1" scrollable max-width="300px">
                        <template v-slot:activator="{ on }">
                            <v-btn
                                :disabled="paises.length == 0"
                                color="warning"
                                dark
                                v-on="on"
                            >
                                seleccionar lugar envio
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>elegir pais</v-card-title>
                            <v-divider></v-divider>
                            <v-card-text style="height: 400px;">
                                <v-radio-group
                                    v-model="paisEnvios"
                                    v-for="pais in paises"
                                    :key="pais.id_pais"
                                    column
                                >
                                    <v-radio
                                        :label="pais.nombre"
                                        :value="pais"
                                    ></v-radio>
                                </v-radio-group>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="cargarListaProveedores"
                                    >aceptar</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    class="blue darken-2 white--text text-right pa-5"
                    cols="3"
                >
                    proveedores
                </v-col>
                <v-col class="blue lighten-5" cols="9">
                    <v-dialog v-model="dialog2" scrollable max-width="300px">
                        <template v-slot:activator="{ on }">
                            <v-btn
                                :disabled="desactivado"
                                color="primary"
                                dark
                                v-on="on"
                            >
                                listado de proveedores
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>elegir proveedor</v-card-title>
                            <v-divider></v-divider>
                            <v-card-text style="height: 400px;">
                                <v-radio-group
                                    v-model="empresaProveedora"
                                    v-for="proveedor in proveedores"
                                    :key="proveedor.id_proveedor"
                                    column
                                >
                                    <v-radio
                                        :label="proveedor.nombre"
                                        :value="proveedor"
                                    ></v-radio>
                                </v-radio-group>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="dialog2 = false"
                                    >aceptar</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-col>
            </v-row>
            </div>
            <v-dialog v-model="dataEval.dialog" max-width="400">
                <v-card>
                    <v-card-title class="headline">{{
                        dataEval.mensaje
                    }}</v-card-title>

                    <v-card-text>
                        {{ dataEval.descripcion }}
                        <v-icon
                            class="pa-3"
                            color="green"
                            v-if="dataEval.status == 1"
                            dark
                            large
                            >mdi-thumb-up</v-icon
                        >
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-col>
                            <v-btn
                                class="text-right"
                                color="red darken-1"
                                v-if="dataEval.cancelar == true"
                                @click="
                                    dataEval.dialog = false;
                                    dataEval.cancelar = false;
                                "
                                text
                            >
                                cancelar
                            </v-btn>
                        </v-col>

                        <v-col>
                            <v-btn
                                class="text-right"
                                color="green darken-1"
                                text
                                @click="ejecutarAccionDialog()"
                            >
                                aceptar
                            </v-btn>
                        </v-col>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-form>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    props: ["productor","formulas"],
    data() {
        return {
            tipoEval: null,
            empresaProveedora: "",
            paisEnvios: "",
            dialog1: false,
            dialog2: false,
            proveedoresInicial: [],
            proveedoresRenovacion: [],
            proveedores: [],
            paises: [],
            desactivado: true,
            dataEval: {
                mensaje: "",
                descripcion: "",
                inicio: "",
                final: "",
                valid: false,
                dialog: false,
                status: 0,
                cancelar: false
            }
        };
    },
    computed: {
        existeFormula (){
            let id;
            for(id in this.formulas){
                if(this.formulas[id].tipopor == this.tipoEval){
                    return true
                }
            }
            return false
        }
    },
    methods: {
        cargarLista(tipoEval) {
            if (tipoEval == "inicial") {
                console.log("hola");
                this.paises = [];
                this.paisEnvios = "";
                this.empresaProveedora = null;
                this.cargarListaPaises();
                this.desactivado = true;
                return;
            }

            if (this.tipoEval == "renovacion") {
                this.paises = [];
                this.paisEnvios = "";
                this.empresaProveedora = "";
                this.desactivado = false;
                this.cargarListaProveedores();
            }
        },
        cargarListaProveedores() {
            if (this.tipoEval == "inicial") {
                this.empresaProveedora = "";
                const params = {
                    tipo_buqueda: "inicial",
                    nombre: this.paisEnvios.nombre
                };
                axios.post(`/proveedores`, params).then(response => {
                    console.log("incial");
                    this.proveedoresInicial = response.data;
                    this.proveedores = response.data;
                });
                this.dialog1 = false;
                this.desactivado = false;
            } else if (this.tipoEval == "renovacion") {
                const params = {
                    tipo_buqueda: "renovacion",
                    id: this.productor.id_productor
                };
                console.log("renovacion");
                axios.post(`/proveedores`, params).then(response => {
                    this.proveedoresRenovacion = response.data;
                    this.proveedores = response.data;
                });
            }
        },
        cargarListaPaises() {
            axios
                .get(`/paises/${this.productor.id_productor}`)
                .then(response => {
                    this.paises = response.data;
                });
        }
    }
};
</script>
