<template>
  <v-container grid-list-xs>
    <div class="text-center">
      <v-dialog v-model="dialog" width="500">       
        <v-card>
          <v-card-title class="text-h5 grey lighten-2">
            Nueva Instalacion
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col class="my-2" cols="12">
                  <v-text-field
                    v-model="newInstalacion.clientid"
                    :counter="10"
                    label="Client Id"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="my-n2">
                  <h3 class="mb-2">Fecha</h3>
                  <v-date-picker v-model="newInstalacion.date"></v-date-picker>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.position"
                    :counter="10"
                    label="Position"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-select
                    v-model="newInstalacion.status"
                    :items="items"
                    label="Status"
                  ></v-select>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.tecnicoid"
                    :counter="10"
                    label="Tecnicoid"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="addInstalacion">
              Añadir Instalación
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <br />
    <v-row>
      <v-col>
        <v-data-table
          :headers="headers"
          :items="instalaciones"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Mis instalaciones</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    @click="dialog=true"
                  >
                    Nueva instalacion
                  </v-btn>              
            </v-toolbar>
          </template>
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
    <v-dialog v-model="editdialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="text-h5">{{ formTitle }}</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-form>
              <v-row>
                <v-col class="my-2" cols="12">
                  <v-text-field
                    v-model="editedItem.clientid"
                    :counter="10"
                    label="Client Id"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="my-n2">
                  <h3 class="mb-2">Fecha</h3>
                  <v-date-picker v-model="editedItem.date"></v-date-picker>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.position"
                    :counter="10"
                    label="Position"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-select
                    v-model="editedItem.status"
                    :items="items"
                    label="Status"
                  ></v-select>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.tecnicoid"
                    :counter="10"
                    label="Tecnicoid"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="close">
            Cancel
          </v-btn>
          <v-btn color="blue darken-1" text @click="editarInstalacion">
            Editar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogDelete" max-width="500px">
      <v-card>
        <v-card-title class="text-h5"
          >Estás seguro de eliminar esta instalación</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeDelete"
            >Cancelar</v-btn
          >
          <v-btn color="blue darken-1" text @click="deleteItemConfirm"
            >OK</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  name: "Instalations",
  data() {
    return {
      instalaciones: [],
      dialog: false,
      editdialog:false,
      newInstalacion: {
        clientid: 0,
        date: "",
        position: "",
        status: "Pending",
        tecnicoid: 1,
      },
      items: ["Pending", "Ready", "Etc"],

      dialogDelete: false,
      headers: [
        {
          text: "Client Id",
          align: "start",
          sortable: false,
          value: "clientid",
        },
        { text: "Date", value: "date" },
        { text: "Position", value: "position" },
        { text: "Status", value: "status" },
        { text: "Tecnicoid", value: "tecnicoid" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      editedIndex: -1,
      editedItem: {
        clientid: 0,
        date: "",
        position: "",
        status: "Pending",
        tecnicoid: 1,
      },
      defaultItem: {
        clientid: 0,
        date: "",
        position: "",
        status: "Pending",
        tecnicoid: 1,
      },
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getInstalaciones();
  },
  methods: {
    getInstalaciones() {
      console.log("buscar instalaciones");
      axios.get("http://localhost:80/instalation/all").then((res) => {
        console.log("instalaciones", res.data);
        this.instalaciones = res.data;
      });
    },
    addInstalacion() {
      console.log("Añadir instalacion");
      this.dialog = false;
      console.log(this.newInstalacion);
      let formData = {
        clientid: parseInt(this.newInstalacion.clientid),
        tecnicoid: parseInt(this.newInstalacion.tecnicoid),
        date: "",
        position: "",
        status: "pending",
      };
      axios
        .post("http://localhost:80/instalation/add", formData)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    editItem(item) {
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.editdialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      axios
        .delete("http://localhost:80/instalation/"+this.editedItem.id)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err);
        });
        this.closeDelete();
    },

    close() {
      this.editdialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    editarInstalacion(){
      this.editdialog=false
      axios
        .put("http://localhost:80/instalation/"+this.editedItem.id,this.editedItem)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err);
        });        
    }
  },
};
</script>

<style>
</style>