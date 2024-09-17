<template lang="">
    <div id="geral" >
        <div class="login-box">
    <h2>Adicionando Usuario</h2>
    <form @submit.prevent="form.get('/cadastro/empresa/novo')" >

      <div class="user-box">
        <input type="text" name="user" required="" v-model="form.user" >
        <label>Nome:</label>
      </div>

      <div class="user-box">
        <input type="text" name="email" required="" v-model="form.email" >
        <label>Email:</label>
        <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.email" >{{ errors.email }}</p>
      </div>


      <div class="user-box">
        <input type="password" name="password" required="" v-model="form.password" >
        <label>Senha</label>
        <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.password" >{{ errors.password }}</p>
      </div>

      <label style="color:white" >Empresas</label>

      <div v-for="empresa in empresas" :key="empresa.id" >
        
        <br>
        <br>
        
        <input
                  type="checkbox"
                  :id="'presenca' + empresa.id"
                  :value="empresa.id"
                  v-model="form.empresas"
                >
              
                <label> {{ empresa.razao }} </label>
         
    </div>

      <br>

      <div id="alinhar">
        <button type="submit">Cadastrar</button>
        <a href="/user/profile">Voltar</a>
      </div>



    </form>
  </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';



const props = defineProps({
    errors: Array,
    empresas: Object,

})



const form = useForm({
    user: '',
    email: '', 
    password: '',
    empresas: [],
})

</script>


<style scoped>
@import "..\Components\css\usuario-filial.css";
</style>