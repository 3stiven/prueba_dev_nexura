<template>
  <div class="container">
    <v-card>
      <v-card-title class="primary--text d-block px-9">
        <h3 class="font-weight-bold mt-2">Asignacion de Cursos</h3>
      </v-card-title>
      <v-card-text>
        <v-data-table
          v-model="registroSeleccion"
          single-select
          show-select
          :headers="data"
          :items="registros"
          :search="buscar_usuarios"
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
                  v-model="buscar_usuarios"
                  placeholder="Buscar..."
                  dense
                  outlined
                  hide-details
                  rounded
                  append-icon="mdi-magnify"
                ></v-text-field>
              </v-responsive>
              <v-spacer></v-spacer>
              Asignar Cursos
              <v-tooltip color="secondary" top>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    v-bind="attrs"
                    v-on="on"
                    :disabled="registros.length == 0 ? true : false"
                    color="blue"
                    @click="asignarCurso"
                    icon
                    class="mr-3"
                  >
                    <v-icon> mdi-plus </v-icon>
                  </v-btn>
                </template>
                <span>Asignar Curso</span>
              </v-tooltip>
            </v-card-title>
          </template>
        </v-data-table>

        <v-dialog
          v-model="dialosAsignarCurso"
          transition="dialog-bottom-transition"
          max-width="600"
        >
          <template v-slot:default="dialosAsignarCurso">
            <v-card>
              <v-toolbar color="primary" dark>Asignar Curso</v-toolbar>
              <v-card-text>
                <v-form ref="curso" v-model="validation" lazy-validation>
                  <v-text-field
                    v-model="nombre"
                    :rules="[rules_form.requerido]"
                    disabled
                    :counter="30"
                    label="Nombre"
                    required
                  ></v-text-field>

                  <v-select
                    :rules="[rules_form.requerido]"
                    v-model="cursosSeleccion"
                    :items="cursos"
                    item-text="nombre"
                    return-object
                    label="Cursos"
                    chips
                    multiple
                    required
                  ></v-select>

                  <!-- <v-alert type="success">
                    <span>1 = Administrador</span> <br />
                    <span>2 = Alumno</span></v-alert
                  > -->

                  <v-btn @click="createUsuarioCurso" color="primary">
                    {{ textoButton }}
                  </v-btn>
                </v-form>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-btn text @click="resetFormCursos">Cerrar</v-btn>
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
      textoButton: "AsignarCurso",
      snackbar_text: null,
      snackbar: false,
      cursosSeleccion: [],
      id: 0,
      nombre: null,
      correo: null,
      telefono: null,
      contrasena: null,
      rol: null,
      buscar_usuarios: "",
      registroSeleccion: [],
      cursos: [],

      form_usuario: {
        id: 0,
        nombre: null,
        correo: null,
        telefono: null,
        contrasena: null,
        rol: null,
      },
      rules_form: {
        requerido: (v) => !!v || "Este campo es requerido",
        numeros: (v) => /^([0-9])*$/.test(v) || "Este campo debe ser númerico",
        email: (v) => /.+@.+\..+/.test(v) || "Correo electrónico no válido",
      },
      dialosAsignarCurso: false,
      loading_items_usuarios: null,

      registros: [],
      data: [
        {
          text: "Nombre",
          align: "start",
          sortable: false,
          value: "name",
        },
        {
          text: "Correo,",
          value: "email",
        },
        { text: "Teléfono", value: "telefono" },
      ],
    };
  },

  mounted() {
    this.getUsuarios();
    this.getCursos();
  },

  methods: {

    asignarCurso() {
      if (this.registroSeleccion[0]) {
        this.id = this.registroSeleccion[0].id;
        this.nombre = this.registroSeleccion[0].name;
        this.correo = this.registroSeleccion[0].email;
        this.telefono = this.registroSeleccion[0].telefono;
        this.contrasena = this.registroSeleccion[0].telefono;
        this.rol = this.registroSeleccion[0].role;

        this.dialosAsignarCurso = true;
      }
    },

    resetFormCursos() {
      this.id = 0;
      this.nombre = null;
      this.correo = null;
      this.telefono = null;
      this.contrasena = null;
      this.rol = null;
      this.cursosSeleccion = [];
      this.dialosAsignarCurso = false;
    },

    createUsuarioCurso() {
      
        if (this.$refs.curso.validate()) {
          axios
            .post("/asignarCurso", {
              cursos: this.cursosSeleccion,
              identificador : this.id,
            })
            .then((response) => {
              // console.log(response.data.response);
              if (response.data.response == 200) {
                this.getUsuarios();
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

    getCursos() {
      axios
        .get("/cursos", {})
        .then((res) => {
          this.cursos = res.data;
        })
        .catch((error) => {});
    },
    getUsuarios() {
      axios
        .get("/usuarios", {})
        .then((res) => {
          this.registros = res.data;
        })
        .catch((error) => {});
    },
  },
};
</script>