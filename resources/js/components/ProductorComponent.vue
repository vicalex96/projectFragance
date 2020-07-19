<template>
  <div>
    <hr class="mt-3">
    <h3> listado de productores </h3>
    <ul class="list-group my-2">
        <li class="list-group-item" 
        v-for="(item, index) in vam_productores " :key="index">
        <span class="badge badge-primary float-right">
        
        </span>
        <p>{{item.nombre}}</p>
        <p>{{item.correo}}</p>
        <p>{{item.pagina}}</p> 

        </li>
    </ul>
  </div>
</template>


<script>
import axios from 'axios'

export default {
    data(){
        return{
            vam_productores: [],
            vam_productor: {nombre:'', correo:'', pagina:'',} 
        }  
    },
    created(){/*ver productores*/
        axios.get('/productores').then(res => {
            this.vam_productores = res.data;
        })
    },

}
</script>