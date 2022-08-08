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
          <span class="text-h5">Nodo Pozo</span>
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
              v-model="factor_pulsos"
              :rules=" [v => !!v || 'Se requiere factor de pulsos',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
              label="Factor de pulsos"
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
              v-model="compania3G"
              :rules="[v => !!v || 'Se requiere la compañia']"
              label="Tipo Compañia"
              required
          >   </v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0"> 
            <v-text-field
              v-model="profundidad_pozo"
              :rules=" [v => !!v || 'Se requiere la profundidad',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
              label="Profundidad del pozo"
              required
              ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
              <v-text-field
              v-model="nivel_estatico"
              :rules=" [v => !!v || 'Se requiere nivel estatico',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
              label="Nivel Estatico"
               required
              ></v-text-field>
          </v-col>

          </v-row>
    

          <v-row>

          <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="nivel_dinamico"
            :rules=" [v => !!v || 'Se requiere nivel dinamico',v => /^[0-9]+,?[0-9]*\b$/.test(v) || 'Debe ser numero',]"
            label="Nivel dinamico"
            required
            ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="referencia_sh"
            :rules="[v => !!v || 'Se requiere la referencia']"
            label="Referencia hidrostatica ubicacion"
            required
            ></v-text-field>
          </v-col>
          
          </v-row>

          <v-row>

          <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="tipo_sensor"
            :rules="[v => !!v || 'Se requiere el tipo de sensor']"
            label="Tipo de sensor"
            required
            ></v-text-field>
          </v-col>

          <v-col class="pt-0 pb-0">
            <v-text-field
            v-model="tipo_energia"
            :rules="[v => !!v || 'Se requiere el tipo de energia']"
            label="Tipo de energia"
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
      fotos:'',
      frecuencia_de_envio:'',
      id_tecnico:'',
      compania3G:'',
      profundidad_pozo:'',
      nivel_estatico:'',
      nivel_dinamico:'',
      referencia_sh:'',
      tipo_sensor:'',
      tipo_energia:'',
      nombre_tecnico:'',
      factor_pulsos:'',
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
        let data ={
          nombre: this.nombre,
          ubicacion: this.ubicacion,
          observaciones: this.observaciones,
          firmware: this.firmware,
          frecuencia_de_envio: parseFloat(this.frecuencia_de_envio),
          id_tecnico: 0,
          tipo_equipo: 'add_pozo',
          compania3G:this.compania3G,
          profundidad_pozo: parseInt(this.profundidad_pozo),
          nivel_estatico: parseInt(this.nivel_estatico),
          nivel_dinamico:  parseInt(this.nivel_dinamico),
          referencia_sh:  this.referencia_sh,
          tipo_sensor: this.tipo_sensor,
          tipo_energia: this.tipo_energia,
          factor_pulsos: parseInt(this.factor_pulsos),
          
        

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
        .post('http://localhost:80/equipos/add_pozo',data)
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