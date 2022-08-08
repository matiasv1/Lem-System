<template >
  <div >
    <!--
      <nav class="mb-10">
        <router-link to="/">Volver al Inicio</router-link> 
        
        
      </nav>
    -->

    <v-navigation-drawer 
       v-model="drawer"
        absolute
        temporary
       
        app clipped>
        <v-list>
          <v-list-item :to="{path: '/'}">
            <v-list-item-action>
              <v-icon>mdi-{{ icons[0] }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Inicio</v-list-item-title>
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
       
       
        

    <row >
        <h1 class="display-2 font-weight-bold mt-5 mb-0">Soporte seleccione el tipo de equipo a verificar</h1> 
    </row>
    <MenuEquiposSoporte class="mt-2"></MenuEquiposSoporte>
    
    
  </div>
</template>

<script>
import MenuEquiposSoporte from '../components/VistasAdmin/MenuEquiposSoporte.vue';





// @ is an alias to /src

export default {
    name: "SoporteView",
    components: {  MenuEquiposSoporte },
    data: () => ({    
    drawer: false,
    icons: ['home','shopping','email'],
  }),
}
</script>

        