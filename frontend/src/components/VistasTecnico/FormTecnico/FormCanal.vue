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
          <span class="text-h5">Nodo Canal</span>
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
           v-model="altura_agua"
           :rules=" [v => !!v || 'Se requiere la Altura del agua',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
          label="Altura del agua"
           required
          ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
          <v-text-field
          v-model="altura_sensor"
          :rules=" [v => !!v || 'Se requiere la Altura del sensor',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
          label="Altura del sensor"
          required
          ></v-text-field>
          </v-col>

           <v-col class="pt-0 pb-0">
          <v-text-field
          v-model="altura_max_canal"
          :rules=" [v => !!v || 'Se requiere la maxima altura',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
          label="Altura maxima del canal"
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
        :disabled="!valid"
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
      items:['Matias Vargas','Nicolas Bernal','Juanito Cea'],
      dialog: false,
      valid: true,
      nombre: '',
      ubicacion: '',
      observaciones:'',
      firmware:'',
      tipo_placa:'',
      fotos:'',
      frecuencia_de_envio:'',
      id_tecnico:'',
      altura_agua:'',
      altura_sensor:'',
      altura_max_canal:'',
      nombre_tecnico:''
    }),
    methods: {
      validate () {
        
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
          altura_agua: parseInt(this.altura_agua),
          altura_sensor: parseInt(this.altura_sensor),
          altura_max_canal: parseInt(this.altura_max_canal),
          id_tecnico: 0,
          tipo_equipo: 'add_canal'

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
        .post('http://localhost:80/equipos/add_canal',data)
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