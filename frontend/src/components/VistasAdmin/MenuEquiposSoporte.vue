<template>
<div>
   <v-col
      cols="12"
      class="py-2"
    >
    <v-card-text>
      <v-row
        align="center"
        justify="center"
      >
        <v-btn-toggle

          class=" white--text"
          background-color="indigo accent-4"   
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
  </v-col>

  <v-row
    justify="center"
    height="100px"
  >

  </v-row >
  <v-row justify="center" v-if="tipo==='Coordinadores'">
    <EquiposCoordinadores class="mt-7"></EquiposCoordinadores>
  </v-row>

  <v-row justify="center" v-if="tipo==='Pozos'">
    <equipos-pozos class="mt-7"></equipos-pozos>
  </v-row>

  <v-row justify="center" v-if="tipo==='Estaciones'">
    <equipos-estaciones class="mt-7"></equipos-estaciones>
  </v-row>

  <v-row justify="center" v-if="tipo==='Canales'">
    <equipos-canales class="mt-7"></equipos-canales>
  </v-row>

  <v-row justify="center" v-if="tipo==='Sondas'">
    <equipos-sonda class="mt-7"></equipos-sonda>
  </v-row>

</div>
</template>


<script>
import EquiposCanales from './EquiposCanales.vue';
import EquiposCoordinadores from './EquiposCoordinadores.vue';
import EquiposEstaciones from './EquiposEstaciones.vue';
import EquiposPozos from './EquiposPozos.vue';
import EquiposSonda from './EquiposSonda.vue';
export default {
    data: () => ({
        tipo: " ",
        
    }),
    components: { EquiposCoordinadores, EquiposSonda, EquiposCanales, EquiposPozos, EquiposEstaciones }
}
</script>

<style>

</style>