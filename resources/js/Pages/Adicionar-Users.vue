<template lang="">
    <div id="geral" >
        <div class="login-box">
    <h2>Adicionando Usuario</h2>
    <form @submit.prevent="form.post('/cadastro/user/adicionar')" >

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


      <div >
      <input v-for="empresa in empresas" :key="empresa.id"
        type="checkbox" 
        :value="empresa.id" 
        v-model="selectedEmpresas"
      >
      <label>Empresas</label>
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

import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    errors: Array,
    empresas: Object,

})

const selectedEmpresas = ref([]);

const form = useForm({
    user: '',
    email: '', 
    password: '',
    empresas: selectedEmpresas,
})

</script>


<style scoped>
@import "..\Components\css\usuario-filial.css";
</style>