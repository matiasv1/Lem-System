<template>
<div>
  <v-card
    flat
    
    
  >
    <v-card-text>
      <v-row
        align="center"
        justify="center"
      >
        <v-btn-toggle

          class=" white--text"
          background-color="blue"   
        >
          <v-btn color="primary" @click="tipo='Coordinadores'">
            Coordinadores
          </v-btn>

          <v-btn color="primary" @click="tipo='Pozos'">
            Pozos
          </v-btn>

          <v-btn color="primary" @click="tipo='Estaciones'">
            Estaciones
          </v-btn>

          <v-btn color="primary" @click="tipo='Canales'">
            Canales
          </v-btn>

          <v-btn color="primary" @click="tipo='Sondas'">
            Sondas
          </v-btn>
        </v-btn-toggle>

      </v-row>
    </v-card-text>
    
  </v-card>

  <v-row
    justify="center"
    height="100px"
  >

  </v-row >
  <v-row justify="center" class="pt-11" v-if="tipo==='Coordinadores'">

    <equipos-coordinadores :id_tecnico="id_tecnico"></equipos-coordinadores>
  </v-row>

  <v-row justify="center" class="pt-11" v-if="tipo==='Pozos'">
    <equipos-pozos :id_tecnico="id_tecnico"></equipos-pozos>
  </v-row>

  <v-row justify="center" class="pt-11" v-if="tipo==='Estaciones'">
    <equipos-estaciones :id_tecnico="id_tecnico"></equipos-estaciones>
  </v-row>

  <v-row justify="center" class="pt-11"  v-if="tipo==='Canales'">
    <equipos-canales :id_tecnico="id_tecnico"></equipos-canales>
  </v-row>

  <v-row justify="center" class="pt-11"  v-if="tipo==='Sondas'">
    <equipos-sonda  :id_tecnico="id_tecnico"> </equipos-sonda>
  </v-row>

</div>
</template>


<script>
import EquiposCoordinadores from '../../VistasTecnico/TablasTecnico/EquiposCoordinadores.vue'
import EquiposSonda from './EquiposSonda.vue'
import EquiposCanales from './EquiposCanales.vue'
import EquiposEstaciones from './EquiposEstaciones.vue'
import EquiposPozos from './EquiposPozos.vue'

export default {
    props: ['id_tecnico'],
    data: () => ({
        tipo: " "
    }),
    components: { EquiposCoordinadores, EquiposSonda, EquiposCanales, EquiposEstaciones, EquiposPozos }
}
</script>

<style>

</style>