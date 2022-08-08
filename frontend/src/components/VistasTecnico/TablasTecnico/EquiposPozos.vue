<template>
  <v-data-table
    :headers="headers"
    :items="Equipos"
    class="elevation-5"
    :loading="loadtable"
    loading-text="Cargando..."
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Pozos </v-toolbar-title>
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
              <span class="text-h5">Editar equipos</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                
                   <v-row>
                    <v-col class="pl-0 pb-0">
                    <v-text-field
                      v-model="editedItem.nombre"
                      label="Nombre equipo"
                    ></v-text-field>
                    </v-col>

                    <v-col>
                      <v-text-field
                      v-model="editedItem.ubicacion"
                      label="Ubicacion"
                    ></v-text-field>
                    </v-col>

                    <v-col class="pr-0 pb-0">
                      <v-text-field
                      v-model="editedItem.frecuencia_de_envio"
                      label="Frecuencia de envio"
                    ></v-text-field>
                    </v-col>
                  </v-row>
                  
                  
                  <v-row>
                    <v-col class="pl-0 pb-0">

                    
                   <v-text-field
                      v-model="editedItem.profundidad_pozo"
                      label="Profundidad del pozo"
                    ></v-text-field>
                    </v-col>

                    <v-col>
                      <v-text-field
                      v-model="editedItem.nivel_estatico"
                      label="Nivel estatico"
                    ></v-text-field>
                    </v-col>

                    <v-col class="pr-0 pb-0">
                      <v-text-field
                      v-model="editedItem.nivel_dinamico"
                      label="Nivel dinamico"
                    ></v-text-field>
                    </v-col>
                  </v-row>

                  <v-row >
                    <v-col class="pl-0 pb-0">
                      <v-text-field
                      v-model="editedItem.factor_pulsos"
                      label="Factor pulsos"
                    ></v-text-field>
                   
                    </v-col>

                    <v-col>
                      <v-text-field
                      v-model="editedItem.tipo_sensor"
                      label="Tipo sensor"
                    ></v-text-field>
                    </v-col>

                    <v-col class="pr-0 pb-0">
                      <v-text-field
                      v-model="editedItem.tipo_energia"
                      label="Tipo de energia"
                    ></v-text-field>
                    </v-col>
                  </v-row>

                  
                  <v-row>
                    <v-col class="pl-0 pb-0">
                      <v-text-field
                      v-model="editedItem.referencia_sh"
                      label="Referencia sensor hidrostatico"
                    ></v-text-field>
                     </v-col>
                     <v-col class="pr-0 pb-0">
                      <v-text-field
                      v-model="editedItem.compania3G"
                      label="Compañia 3G"
                    ></v-text-field>

                     </v-col>
                  </v-row>

                  <v-row
                    >
                    <v-text-field
                      v-model="editedItem.observaciones"
                      label="Observaciones"
                    ></v-text-field>
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
                Cancelar
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Guardar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">¿Estas seguro que deseas eliminar?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
        
        
      </v-toolbar>

    </template>
    <template v-slot:[`item.estado`]="{ item }">
      <v-chip
        :color="getColor(item.estado)"
        dark
      >
        {{ item.estado }}
      </v-chip>
      
    </template>

    <template v-slot:[`item.actions`]="{ item }" >
      <v-btn
        elevation="2"
        small
        fab
        color="success"
        class="mr-2"
        @click="editItem(item)"
      >
        <v-icon >
        mdi-pencil
        </v-icon> 
        
      </v-btn>

      <v-btn
        elevation="2"
        small
        fab
        color="error"
        class="mr-2"
        @click="deleteItem(item)"
      >
        <v-icon >
        mdi-delete
      </v-icon>
      
      </v-btn>

      <v-btn
        elevation="2"
        small
        fab
        color="primary"
        class="mr-2"
        @click="mostrarMensaje(item)"
      >
        <v-icon >
        mail
      </v-icon>
      
      </v-btn>
    </template>
    
  </v-data-table>
  
</template>

<script>
  import axios from "axios"
    export default {
      props: ['id_tecnico'],
      data: () => ({
        dialog: false,
        loadtable:true,
        dialogDelete: false,
        dialogMensaje: false,
        dialogTecnico: false,
        headers: [
            {   
                text: 'Nombre',
                align: 'start',
                value: 'nombre',
            },
            { text: 'Estado', value: 'estado' },
            { text: 'Observaciones', value: 'observaciones' },
            { text: 'Tiempo de Creacion', value: 'time_create' },
            { text: 'Actions', value: 'actions', sortable: false }
            
            
        ],
        Equipos:[],
        editedIndex: -1,
        editedItem: {
          nombre: '',
          estado: '',
          observaciones: '',
          frecuencia_de_envio: 1,
          ubicacion:'',
          firmware:'',
          profundidad_pozo:'',
          nivel_estatico:'',
          nivel_dinamico:'',
          referencia_sh:'',
          tipo_sensor:'',
          tipo_energia:'',
          factor_pulsos:'',
          compania3G:'',
          mensaje:'',
          
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
            axios.get("http://localhost:80/tecnico/"+this.id_tecnico+"/equipos/5").then((res) => {
            console.log("instalaciones", res.data);
            this.loadtable=false;
            this.Equipos = res.data;});
        },

        change_state(item,id, estado){
          this.editedIndex = this.Equipos.indexOf(item)

          var data={
            id_equipo:parseInt(id),
            estado: ""
          }
          if (estado==='En espera'){
            item.estado = "Resuelto"
            data.estado = "Resuelto"
          }

          else if (estado==='Resuelto'){
            
            data.estado = "En espera"
            item.estado = "En espera"
          }
           else if (estado==='Resuelto'){
            
            data.estado = "En espera"
            item.estado = "En espera"
          }
        

        axios
        .post("http://localhost:80/equipos/change_state", data)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err);
        });
        },

        mostrarMensaje (item) {
          this.editedIndex = this.Equipos.indexOf(item)
          this.editedItem = Object.assign({}, item)
          console.log(this.editedItem)
          this.dialogMensaje = true
        },
        CerrarInfo (){
          this.dialogMensaje = false
        },
        getColor (estado) {
                if (estado === 'En espera') return 'red'
                else if(estado ==='Resuelto') return 'green'
                else{
                  return 'orange'
                }
                
            },
  
        editItem (item) {
          this.editedIndex = this.Equipos.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        },

        mostrarTecnico () {
          this.dialogTecnico = true
        },
  
        deleteItem (item) {
          this.editedIndex = this.Equipos.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialogDelete = true
        },
  
        deleteItemConfirm () {
          this.Equipos.splice(this.editedIndex, 1)
          axios
          .delete("http://localhost:80/equipos/"+this.editedItem.id_equipo)
          .then((res) => {
              console.log("resultado del delete", res);
              this.getInstalaciones();
              })
              .catch((err) => {
              console.log(err);
              });
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
            this.editedItem.frecuencia_de_envio = parseInt(this.editedItem.frecuencia_de_envio )
            this.editedItem.profundidad_pozo = parseInt(this.editedItem.profundidad_pozo )
            this.editedItem.nivel_estatico = parseInt(this.editedItem.nivel_estatico )
            this.editedItem.nivel_dinamico = parseInt(this.editedItem.nivel_dinamico )
            this.editedItem.factor_pulsos = parseInt(this.editedItem.factor_pulsos )
            
            Object.assign(this.Equipos[this.editedIndex], this.editedItem)
            
            axios
              .put("http://localhost:80/equipos/"+this.editedItem.id,this.editedItem)
              .then((res) => {
              console.log("resultado de post", res);
              this.getInstalaciones();
              })
              .catch((err) => {
              console.log(err);
              });
            
          } else {
            this.Equipos.push(this.editedItem)
          }
          this.close()
        },
      },
    }
  </script>