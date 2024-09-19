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
            <input @input="formatCNPJ"
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
            <Link href="/selecionar/filial">Voltar</Link>
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

function formatCNPJ() {
  let cnpj = form.cnpj.replace(/\D/g, ''); // Remove qualquer coisa que não seja dígito

  // Limita o CNPJ a no máximo 14 dígitos
  if (cnpj.length > 14) {
    cnpj = cnpj.slice(0, 14); 
  }

  cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
  cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
  cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
  cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');

  form.cnpj = cnpj;
}
  </script>
  
  <style scoped>
  @import "../Components/css/usuario-filial.css";


  </style>
  