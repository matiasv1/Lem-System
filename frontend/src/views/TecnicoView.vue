<template>
  <div >
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
    <!--
    <nav>
        <router-link to="/">Volver al Inicio</router-link> |
        <router-link to="/Formularios">Formulario de Equipos</router-link> |
        <router-link to="/Tecnico">Ver equipos</router-link> 
        
    </nav>
    -->  
    <v-row justify="center">
      <v-col>
       <h1 class="display-2 font-weight-bold mt-5">Técnico seleccione su nombre y sus equipos</h1> 
      </v-col>

    </v-row>
     
    <v-row justify="center" class="pt-0 pb-0 ">
      
      <v-col
        class="d-flex"
        cols="12"
        sm="3"
        color="green"
        justify="center"
      >
        <v-select
          :items="items"
          label="Seleccione su nombre"
          v-model="selected"
          solo
        ></v-select>
      </v-col>
   
    </v-row >
    
    <v-row justify="center " class="pt-0 pb-15" v-if="selected === 'Matias Vargas'">
        <MenuEquipos id_tecnico="1"></MenuEquipos>
    </v-row> 

    <v-row justify="center" class="pt-0 pb-15" v-if="selected === 'Nicolas Bernal'">
        <MenuEquipos id_tecnico="2"></MenuEquipos>
    </v-row> 
    <v-row justify="center" class="pt-0 pb-15" v-if="selected === 'Juanito Cea'">
        <MenuEquipos id_tecnico="3"></MenuEquipos>
    </v-row> 
    
  </div>
</template>

<script>


import MenuEquipos from '../components/VistasTecnico/TablasTecnico/MenuEquipos.vue';

// @ is an alias to /src

export default {
    name: "Tecnicoview",
    components: { MenuEquipos },
    data: () =>({
      selected: '',
      items:['Matias Vargas','Nicolas Bernal','Juanito Cea'],
      drawer: false,
      icons: ['home','engineering','email'],
    })
}
</script>