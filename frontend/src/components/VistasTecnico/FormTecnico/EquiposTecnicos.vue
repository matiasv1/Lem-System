<template>
  <v-data-table
    :headers="headers"
    :items="Equipos"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.nombre"
                      label="Dessert name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.estado"
                      label="Estado"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.observaciones"
                      label="Observaciones"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.time_create"
                      label="Tiempo de Creacion"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                   
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      
    </template>
    <template v-slot:item.estado="{ item }">
      <v-chip
        :color="getColor(item.estado)"
        dark
      >
        {{ item.estado }}
      </v-chip>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    
  </v-data-table>
</template>

<script>
  import axios from "axios"
    export default {
      data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {   
                text: 'Nombre',
                align: 'start',
                value: 'nombre',
            },
            { text: 'Estado', value: 'estado' },
            { text: 'Observaciones', value: 'observaciones' },
            { text: 'Tiempo de Creacion', value: 'time_create' },
            { text: 'Actions', value: 'actions', sortable: false },
            
        ],
        Equipos:[],
        editedIndex: -1,
        editedItem: {
          nombre: '',
          estado: '',
          observaciones: '',
          time_create: '',
        },
        defaultItem: {
          nombre: '',
          estado: '',
          observaciones: '',
          time_create: '',
        },
      }),
  
      computed: {
        formTitle () {
          return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
      },
  
      watch: {
        dialog (val) {
          val || this.close()
        },
        dialogDelete (val) {
          val || this.closeDelete()
        },
      },
  
      created() {
            this.getInstalaciones();
      },
  
      methods: {
        getInstalaciones() {
            console.log("buscar instalaciones");
            // Hay que sacar el id de alguna forma
            axios.get("http://localhost:80/equipos/1").then((res) => {
            console.log("instalaciones", res.data);
            this.Equipos = res.data;});
        },
        getColor (estado) {
                if (estado === 'En espera') return 'red'
                
            },
  
        editItem (item) {
          this.editedIndex = this.Equipos.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        },
  
        deleteItem (item) {
          this.editedIndex = this.Equipos.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialogDelete = true
        },
  
        deleteItemConfirm () {
          this.Equipos.splice(this.editedIndex, 1)
          this.closeDelete()
        },
  
        close () {
          this.dialog = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },
  
        closeDelete () {
          this.dialogDelete = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },
  
        save () {
          if (this.editedIndex > -1) {
            Object.assign(this.Equipos[this.editedIndex], this.editedItem)
          } else {
            this.Equipos.push(this.editedItem)
          }
          this.close()
        },
      },
    }
  </script>