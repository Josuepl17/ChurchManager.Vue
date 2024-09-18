<template lang="">
<div id="geral">
    <div class="login-box">
        <h2>Crie Sua Conta</h2>
        <form @submit.prevent="form.post('/cadastro/usuario')">
    
          <div class="user-box">
            <input v-model="form.nome" type="text" name="nome" required="">
            <label>Nome:</label>
          </div>
    
          <div class="user-box">
            <input v-model="form.email" type="text" name="email" id="email" required="" >
            <label>Email:</label>
            <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.email" >{{ errors.email }}</p>
          </div>
    
    
          <div class="user-box">
            <input v-model="form.password" type="password" name="password" required="">
            <label>Senha:</label>
            <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.password" >{{ errors.password }}</p>
          </div>
    
    
          <div class="user-box">
            <input v-model="form.razao" type="text" name="razao" required="" >
            <label>Razão Social:</label>
          </div>
    
          <div class="user-box">
            <input v-model="form.cnpj" type="text" name="cnpj" required="" >
            <label>CNPJ:</label>
            <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.cnpj" >{{ errors.cnpj }}</p>
          </div>
    
    
          <div id="alinhar-esquerda">
            <button type="submit">Cadastrar</button>
    
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

})

const form = useForm({
    nome: '',
    email: '', 
    password: '',
    razao: '',
    cnpj: '',

})

</script>




<style scoped >
    @import "..\Components\css\usuario-filial.css";
</style>