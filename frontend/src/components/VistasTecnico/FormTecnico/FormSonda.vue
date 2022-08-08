<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="500px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark class="text-right" v-bind="attrs" v-on="on">
          Agregar
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Nodo Sonda</span>
        </v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col class="pt-0 pb-0">
            <v-text-field
              v-model="ubicacion"
              :rules="[v => !!v || 'Se requiere la ubicacion']"
              label="Campo de ubicacion"
              required
            ></v-text-field>
            </v-col>

            <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="nombre"
            :rules ="[v => !!v || 'Se requiere el nombre']"
            label="Nombre Router"
            required
            ></v-text-field>
            </v-col>
          </v-row>


          <v-row>
            <v-col class="pt-0 pb-0">

            <v-select
             v-model="nombre_tecnico"
              :items="items"
              :rules="[v => !!v || 'Se requiere seleccionar']"
              label="Nombre Tecnico"
              required
            ></v-select>

            </v-col>

            <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="firmware"
            :rules="[v => !!v || 'Se el Firmware']"
            label="Firmware utilizado"
            required
            ></v-text-field>
            </v-col>
          </v-row>

          <v-row>

          <v-col class="pt-0 pb-0">
          <v-text-field
           v-model="tipo_placa"
            :rules="[v => !!v || 'Se requiere tipo de placa']"
          label="Tipo placa"
           required
          ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
          <v-text-field
          v-model="frecuencia_de_envio"
          :rules=" [v => !!v || 'Se requiere la frecuencia',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
          label="Frecuencia de Envio"
          required
          ></v-text-field>
          </v-col>

          </v-row>

          <v-row>

          <v-col class="pt-0 pb-0">
          <v-text-field
           v-model="tipo_sonda"
           :rules="[v => !!v || 'Se requiere el tipo de sonda']"
          label="Tipo de sonda"
           required
          ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
          <v-text-field
           v-model="compania3G"
           :rules="[v => !!v || 'Se requiere la compañia']"
          label="Compañia 3G"
           required
          ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
          <v-text-field
          v-model="largo_sonda"
          :rules=" [v => !!v || 'Se requiere el largo de la sonda',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
          label="Largo de sonda"
          required
          ></v-text-field>
          </v-col>

          </v-row>

          
        <v-textarea
            v-model="observaciones"
            :rules="[v => !!v || 'Se requiere observaciones']"
            label="Observaciones"
            required
        ></v-textarea>

        <v-btn
        color="success"
        class="mr-4"
        @click="validate"
        > Enviar
        </v-btn>

        <v-btn
        color="error"
        class="mr-4"
        @click="reset"
        >
        Reset Form
        </v-btn>

        <v-btn
        color="warning"
        class="mr-4"
        @click="cerrar"
        >
        Cerrar
        </v-btn>

      
  </v-form>
        </v-card-text>
        </v-card>
    </v-dialog>
  </v-row>
</template>


<script>
import axios from "axios";
  export default {
    data: () => ({
      dialog: false,
      valid: true,
      items:['Matias Vargas','Nicolas Bernal','Juanito Cea'],
      nombre: '',
      ubicacion: '',
      observaciones:'',
      firmware:'',
      tipo_placa:'',
      fotos:'',
      frecuencia_de_envio:'',
      id_tecnico:'',
      compania3G:'',
      tipo_sonda:'',
      largo_sonda:'',
      nombre_tecnico:''
    }),
    methods: {
      validate () {
        this.$refs.form.validate()
        if(this.$refs.form.validate()){
          console.log(this.$refs.form.validate())
          this.addEquipo()
        }
      },

      addEquipo(){
        
        this.dialog = false
        var data ={
          nombre: this.nombre,
          ubicacion: this.ubicacion,
          observaciones: this.observaciones,
          firmware: this.firmware,
          frecuencia_de_envio: parseFloat(this.frecuencia_de_envio),
          tipo_placa: this.tipo_placa,
          compania3G: this.compania3G,
          tipo_sonda:this.tipo_sonda,
          largo_sonda: parseInt(this.largo_sonda),

          id_tecnico: 0,
          tipo_equipo: 'add_estacion'

        }
        console.log(this.nombre_tecnico)
        if (this.nombre_tecnico==='Matias Vargas'){
          
          data.id_tecnico=1
        }
        else if (this.nombre_tecnico==='Nicolas Bernal'){
          data.id_tecnico=2
        }

        else if (this.nombre_tecnico==='Juanito Cea'){
          data.id_tecnico=3
        }
        console.log(data)
        axios
        .post('http://localhost:80/equipos/add_sonda',data)
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
        console.log(error);
        });

        this.$refs.form.reset()
      },

      reset(){
        this.$refs.form.reset()
      },

      cerrar(){
        this.dialog = false
        this.$refs.form.reset()
      },

      resetValidation () {
        this.$refs.form.resetValidation()
      },
    },
  }
</script>