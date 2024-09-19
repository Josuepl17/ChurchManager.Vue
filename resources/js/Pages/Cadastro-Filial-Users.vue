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
            <div id="validation">
              <p style="color: red; font-size:13px; margin-top:-18px; padding-bottom:20px;" v-if="errors.email" >{{ errors.email }}</p>
            </div>
          </div>
    
    
          <div class="user-box">
            <input v-model="form.password" type="password" name="password" required="">
            <label>Senha:</label>
              <p style="color: red; font-size:13px; margin-top:-18px; padding-bottom:20px;" v-if="errors.password" >{{ errors.password }}</p>
          </div>
    
    
          <div class="user-box">
            <input v-model="form.razao" type="text" name="razao" required="" >
            <label>Razão Social:</label>
          </div>
    
          <div class="user-box">
            <input v-model="form.cnpj" @input="formatCNPJ" type="text" name="cnpj" required="" >
            <label>CNPJ:</label>

              <p style="color: red; font-size:13px; margin-top:-18px; padding-bottom:20px;" v-if="errors.cnpj" >{{ errors.cnpj }}</p>

          </div>
    
    
          <div id="alinhar-esquerda">
            <button type="submit">Cadastrar</button> <span style="padding:10px"></span>
            <Link id="botao-link" href="/login">Voltar</Link>
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




<style scoped >
    @import "..\Components\css\usuario-filial.css";
</style>