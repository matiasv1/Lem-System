<template>
  <v-data-table
    :headers="headers"
    :items="Equipos"
    class="elevation-1"
  >
  <template v-slot:item.estado="{ item }">
      <v-chip
        :color="getColor(item.estado)"
        dark
      >
        {{ item.estado }}
      </v-chip>
    </template>
  </v-data-table>
</template>

<script>
import axios from "axios"
    export default{
        data:() =>({
            headers: [
            {   
                text: 'Nombre',
                align: 'start',
                value: 'nombre',
            },
            { text: 'Estado', value: 'estado' },
            { text: 'Observaciones', value: 'observaciones' },
            { text: 'Tiempo de Creacion', value: 'time_create' },
            
            
        ],
            Equipos:[]

        }),
        created() {
            this.getInstalaciones();
        },
        methods:{
            getInstalaciones() {
            console.log("buscar instalaciones");
            // Hay que sacar el id de alguna forma
            axios.get("http://localhost:80/equipos/1").then((res) => {
            console.log("instalaciones", res.data);
            this.Equipos = res.data;});
            },
            getColor (estado) {
                if (estado === 'En espera') return 'red'
                
            },
        },

        
    }
    
</script>
