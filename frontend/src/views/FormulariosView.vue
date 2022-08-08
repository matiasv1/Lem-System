<template>
  <v-div>
    <v-navigation-drawer 
       v-model="drawer"
        absolute
        temporary
       
        app clipped>
        <v-list>
          <v-list-item :to="{path: '/'}">
            <v-list-item-action>
              <v-icon color="indigo accent-4">home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Inicio</v-list-item-title>
            </v-list-item-content>
          </v-list-item>                    
           <v-list-item :to="{path: '/Formularios'}">
            <v-list-item-action>
              <v-icon color="indigo accent-4" >construction</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Ingresar Equipo</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{path: '/Tecnico'}">
            <v-list-item-action>
              <v-icon color="indigo accent-4">engineering</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mis Equipos</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer >
      
       <v-system-bar color="indigo darken-2"></v-system-bar>      
      <v-app-bar class="indigo accent-4 white--text">
      <v-app-bar-nav-icon @click="drawer=true" class="white--text"></v-app-bar-nav-icon>
        <v-toolbar-title>                
        <v-list-item :to="{path: '/'}">                
        <v-img
          alt="Vuetify Logo"
          class="shrink mr-2"
          contain
          src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"
          transition="scale-transition"
          width="40"         
          :to="{path: '/'}" 
        />
        </v-list-item>
        </v-toolbar-title>
      </v-app-bar>

  <h1 class="display-2 font-weight-bold mt-5">Técnico agregue su equipo</h1> 
  <v-row justify="center" class="mt-10">
  <v-col cols="12"
        sm="5"
        >
    
  <v-simple-table  class="elevation-3" >
    <template v-slot:default >
      <thead>
        <tr class="primary">
          <th class="white--text font-weight-bold">Nombre Equipo</th>
          <th class="white--text font-weight-bold text-center" >Accion</th>
        </tr>

    
      </thead>
      <tbody>
        <tr >
          <td class="text-left display-5 font-weight-bold mt-10">Nodo Coordinador</td>
          <td  ><form-coordinador></form-coordinador></td>
        </tr>
        <tr>
          <td class="text-left display-5 font-weight-bold mt-10">Nodo Pozo</td>
          <td class="button-right"><form-pozo></form-pozo></td>
        </tr>
        <tr>
          <td class="text-left display-5 font-weight-bold mt-10">Nodo Canal</td>
          <td class="button-right"><form-canal></form-canal></td>
        </tr>
        <tr>
          <td class="text-left display-5 font-weight-bold mt-10">Nodo Estacion</td>
          <td class="button-right"><form-estacion></form-estacion></td>
        </tr>
        <tr>
          <td class="text-left display-5 font-weight-bold mt-10">Nodo Sonda</td>
          <td class="button-right"><form-sonda></form-sonda></td>
        </tr>
      </tbody>
    </template>
    

  </v-simple-table>
  </v-col>
  </v-row>
</v-div> 
</template>

<script>
import FormCoordinador from "../components/VistasTecnico/FormTecnico/FormCoordinador.vue";
import FormPozo from "../components/VistasTecnico/FormTecnico/FormPozo.vue";
import FormCanal from "../components/VistasTecnico/FormTecnico/FormCanal.vue";
import FormEstacion from "../components/VistasTecnico/FormTecnico/FormEstacion.vue";
import FormSonda from '../components/VistasTecnico/FormTecnico/FormSonda.vue';




  export default {
    components:{
    FormCoordinador,
    FormPozo,
    FormCanal,
    FormEstacion,
        FormSonda
},
    data () {
      return {
        selected:"",
        tipo: ["Nodo coordinador","Nodo Pozo", "Nodo Canal","Nodo Estacion"],
        drawer: false,
      }
    },
  }
  
</script>
