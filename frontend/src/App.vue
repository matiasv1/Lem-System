<template>
  <v-app>
    <div id="app">
      <!-- <nav>
        <router-link to="/">Informacion de Soporte</router-link> |
        <router-link to="/about">Formularios</router-link>|
        <router-link to="/Data">Equipos de tecnicos</router-link>
      </nav> -->
      <router-view/>
    </div>
  </v-app>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin: 0;
}
body {
  margin: 0;
 }


</style>
