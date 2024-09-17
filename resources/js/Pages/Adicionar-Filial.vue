<template>
    <div id="geral">
      <div class="login-box">
        <h2>Nova Filial</h2>
        <form @submit.prevent="form.post('/cadastro/empresa/novo')">
  
          <div class="user-box">
            <input
              type="text"
              name="razao"
              required
              v-model="form.razao"
            >
            <label>Razão Social:</label>
          </div>
  
          <div class="user-box">
            <input
              type="text"
              name="cnpj"
              required
              v-model="form.cnpj"
            >
            <label>CNPJ:</label>
            <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.cnpj">
              {{ errors.cnpj }}
            </p>
          </div>
  
          <div style="color: white;">
            <div v-for="user in users" :key="user.id">
              <input
                type="checkbox"
                :id="'user_id' + user.id"
                :value="user.id"
                v-model="form.user"
              >
              <label :for="'user_id' + user.id">{{ user.nome }}</label>
            </div>
          </div>
  
          <br>
  
          <div id="alinhar">
            <button type="submit">Adicionar</button>
            <a href="/selecionar/filial">Voltar</a>
          </div>
  
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
  
  const form = useForm({
    razao: '',
    cnpj: '',
    user: [],
  });

  const props = defineProps({
    errors: Array,
    users: Object,

})
  


  
  </script>
  
  <style scoped>
  @import "../Components/css/usuario-filial.css";
  </style>
  