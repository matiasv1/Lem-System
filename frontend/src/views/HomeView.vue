<template>
  <v-container class="mt-8 " fluid>
    <v-row class="mb-0 mt-0">
      <v-col>
        
        <h1 class="display-2 font-weight-bold ">Seleccione su tipo de rol</h1> 
      </v-col>
    </v-row>
    
    <v-row class="justify-center mt-0 p-0">
    <v-img
          alt="Vuetify Logo"
          class="shrink mt-0 pt-0 "
          contain
          
          src="http://44.201.55.110/wp-content/uploads/2016/03/lem-2-490x326-c-default.png"
          transition="scale-transition"
          width="380"         
           
        />
    </v-row>
    <v-row class="mt-0 pt-0">
      <v-col>
        <v-btn color="primary mr-4" x-large>
          <router-link to="/Soporte" style="text-decoration: none; color: inherit;" >Informacion de Soporte</router-link>
        </v-btn>

        <v-btn color="success ml-4" x-large>
          <router-link to="/Formularios" style="text-decoration: none; color: inherit;" >Informacion de Tecnico</router-link>
        </v-btn>
      </v-col>
    </v-row>
    
    
    
    
  </v-container>
</template>

<script>




// @ is an alias to /src

export default {
    name: "HomeView",
    components: {}
}
</script>
