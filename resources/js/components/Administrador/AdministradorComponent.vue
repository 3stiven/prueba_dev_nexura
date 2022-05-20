<template>
  <div class="container">
    <v-card>
      <v-card-title class="primary--text d-block px-9">
        <h3 class="font-weight-bold mt-2">Gestión de Empleados</h3>
      </v-card-title>
      <v-card-text>
        <v-data-table
          v-model="registroSeleccion"
          :headers="data"
          :items="registros"
          :search="buscar_empleado"
          item-key="id"
          class="elevation-0 custom-table"
          :footer-props="{
            'items-per-page-text': 'Usuarios por página',
            pageText: '{0}-{1} de {2}',
          }"
        >
          <template v-slot:top>
            <v-card-title>
              <v-responsive class="pt-2" max-width="400">
                <v-text-field
                  v-model="buscar_empleado"
                  placeholder="Buscar..."
                  dense
                  outlined
                  hide-details
                  rounded
                  append-icon="mdi-magnify"
                ></v-text-field>
              </v-responsive>
              <v-spacer></v-spacer>

              <v-btn
                @click="dialogNuevoUsuario = true"
                color="primary"
                depressed
                rounded
                class="text-capitalize"
              >
                <v-icon left>mdi-plus</v-icon> Crear Nuevo Empleado
              </v-btn>
            </v-card-title>
          </template>
          <template v-slot:[`item.boletin`]="{ item }">
            <h6>
              {{ item.boletin == 0 ? "NO" : "SI" }}
            </h6>
          </template>

          <template v-slot:[`item.modificar`]="{ item }">
            <v-btn
              outlined
              color="secondary"
              icon
              class="mr-9"
              @click="editarUsuario(item)"
            >
              <v-icon> mdi-pencil </v-icon>
            </v-btn>
          </template>

          <template v-slot:[`item.eliminar`]="{ item }">
            <v-btn
              outlined
              color="secondary"
              icon
              class="mr-9"
              @click="deleteEmpleado(item.id)"
            >
              <v-icon> mdi-delete </v-icon>
            </v-btn>
          </template>
        </v-data-table>

        <v-dialog
          v-model="dialogNuevoUsuario"
          transition="dialog-bottom-transition"
          max-width="700"
        >
          <template v-slot:default="dialog">
            <v-card>
              <v-toolbar color="primary" dark>Cear Empleado</v-toolbar>

              <v-card-text>
                <v-form ref="registro" v-model="validation" lazy-validation>
                  <v-alert color="blue" text type="info"
                    >Los campos con asteriscos (*) son obligatorios</v-alert
                  >
                  <v-row no-gutters>
                    <v-col class="titulo" cols="12" sm="4">
                      <span> Nombre Completo * </span>
                    </v-col>
                    <v-col cols="12" sm="8">
                      <v-text-field
                        v-model="form_empleado.nombre"
                        :rules="[rules_form.requerido]"
                        :counter="30"
                        label="Nombre completo del empleado"
                        solo
                        required
                      ></v-text-field>
                    </v-col>

                    <v-col class="titulo" cols="12" sm="4">
                      <span> * Correo Electronico * </span>
                    </v-col>
                    <v-col cols="12" sm="8">
                      <v-text-field
                        v-model="form_empleado.email"
                        type="email"
                        :rules="[rules_form.email, rules_form.requerido]"
                        label="Correo Electronico"
                        solo
                        required
                      ></v-text-field>
                    </v-col>

                    <v-col class="titulo" cols="12" sm="4">
                      <span> Sexo * </span>
                    </v-col>
                    <v-col cols="12" sm="8">
                      <v-radio-group
                        :rules="[rules_form.requerido]"
                        v-model="form_empleado.sexo"
                        column
                      >
                        <v-radio label="Masculino" value="M"></v-radio>
                        <v-radio label="Femenino" value="F"></v-radio>
                      </v-radio-group>
                    </v-col>

                    <v-col class="titulo" cols="12" sm="4">
                      <span> Área *</span>
                    </v-col>
                    <v-col cols="12" sm="8">
                      <v-select
                        solo
                        :rules="[rules_form.requerido]"
                        v-model="form_empleado.area"
                        :items="areas"
                        item-value="id"
                        item-text="nombre"
                        hide-details
                        required
                        class="mt-0"
                      ></v-select>
                    </v-col>

                    <v-col class="titulo" cols="12" sm="4">
                      <span> Descripcion *</span>
                    </v-col>
                    <v-col class="mt-2" cols="12" sm="8">
                      <v-textarea
                        :rules="[rules_form.requerido]"
                        v-model="form_empleado.descripcion"
                        label="Descripcion"
                        solo
                        auto-grow
                        row-height="25"
                      ></v-textarea>
                    </v-col>

                    <v-col cols="12" sm="4"> </v-col>
                    <v-col cols="12" sm="8">
                      <v-checkbox
                        v-model="form_empleado.boletin"
                        label="Deseo recibir boletin informativo"
                      ></v-checkbox>
                    </v-col>

                    <v-col class="titulo" cols="12" sm="4">
                      <span> Roles *</span>
                    </v-col>
                    <v-col cols="12" sm="8">
                      <v-checkbox
                        v-model="form_empleado.selected_roles"
                        v-for="r in roles"
                        :key="r.id"
                        :label="r.nombre"
                        :value="r.id"
                        hide-details
                        required
                      ></v-checkbox>
                    </v-col>
                  </v-row>

                  <v-btn @click="createUsuario(textoButton)" color="primary">
                    {{ textoButton }}
                  </v-btn>
                </v-form>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-btn text @click="resetFormEditorial">Cerrar</v-btn>
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>

        <v-snackbar
          v-model="snackbar"
          absolute
          top
          right
          tile
          color="green accent-2"
        >
          <v-icon>mdi-account-key</v-icon> {{ snackbar_text }}
        </v-snackbar>
      </v-card-text>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      validation: null,
      textoButton: "Registrar",

      snackbar_text: null,
      snackbar: false,

      buscar_empleado: "",
      registroSeleccion: [],
      form_empleado: {
        id: 0,
        nombre: null,
        email: null,
        sexo: null,
        area: null,
        descripcion: null,
        boletin: false,
        selected_roles: [],
      },
      rules_form: {
        requerido: (v) => !!v || "Este campo es requerido",
        numeros: (v) => /^([0-9])*$/.test(v) || "Este campo debe ser númerico",
        email: (v) => /.+@.+\..+/.test(v) || "Correo electrónico no válido",
      },
      dialogNuevoUsuario: false,
      loading_items_usuarios: null,
      search: "",

      roles: [],
      areas: [],

      registros: [],
      data: [
        {
          text: "Nombre",
          align: "start",
          sortable: false,
          value: "nombre",
        },
        {
          text: "Email,",
          value: "email",
        },
        { text: "Sexo", value: "sexo" },
        { text: "Área", value: "area.nombre" },
        { text: "Boletin", value: "boletin" },
        { text: "Modificar", value: "modificar" },
        { text: "Eliminar", value: "eliminar" },
      ],
    };
  },

  mounted() {
    this.getEmpleados();
    this.getRoles();
    this.getAreas();
  },

  methods: {
    editarUsuario(item) {
      // this.editedIndex = this.desserts.indexOf(item)
      this.form_empleado = Object.assign({}, item);
      this.dialogNuevoUsuario = true;
      this.textoButton = "Actualizar";
    },

    deleteEmpleado(id) {
      axios
        .post("/deleteEmpleado", {
          identifier: id,
        })
        .then((response) => {
          console.log();
          this.getEmpleados(response.data.responseText);
          this.snackbar_text = response.data.responseText;
          this.snackbar = true;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    resetFormEditorial() {
      this.id = 0;
      this.nombre = null;
      this.correo = null;
      this.telefono = null;
      this.contrasena = null;
      this.rol = null;
      this.textoButton = "Registrar";
      this.dialogNuevoUsuario = false;
    },

    createUsuario(form) {
      if (form == "Registrar") {
        if (this.$refs.registro.validate()) {
          if (this.form_empleado.selected_roles != "") {
            axios
              .post("/createEmpleado", {
                informacion: this.form_empleado,
              })
              .then((response) => {
                // console.log(response.data.response);
                if (response.data.response == 200) {
                  this.getEmpleados();
                  this.dialogNuevoUsuario = false;
                  this.snackbar_text = response.data.responseText;
                  this.snackbar = true;
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }else{
            this.snackbar_text = "Seleccione Como minimo un ROL";
            this.snackbar = true;
          }
        }
      } else {
        axios
          .post("/updateEmpleado", {
            informacion: this.form_empleado,
          })
          .then((response) => {
            // console.log(response.data.response);
            if (response.data.response == 200) {
              this.getEmpleados();
              this.dialogNuevoUsuario = false;
              this.snackbar_text = response.data.responseText;
              this.snackbar = true;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    getEmpleados() {
      axios
        .get("/empleados", {})
        .then((res) => {
          this.registros = res.data;
        })
        .catch((error) => {});
    },

    getRoles() {
      axios
        .get("/getRoles", {})
        .then((res) => {
          this.roles = res.data;
        })
        .catch((error) => {});
    },

    getAreas() {
      axios
        .get("/getAreas", {})
        .then((res) => {
          this.areas = res.data;
        })
        .catch((error) => {});
    },
  },
};
</script>
<style>
.row.no-gutters > [class*="col-"].titulo {
  padding-top: 12px !important;
  justify-content: center !important;
  display: flex !important;
}
</style>