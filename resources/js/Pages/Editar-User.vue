<template lang="">

<div id="geral" >
    <div class="login-box">
  <h2>Edição de Usuario</h2>
  <form  @submit.prevent="form.post('/editar/user')">

    <div class="user-box">
      <input type="text" name="nome" required="" v-model="form.nome" >
      <label>Nome:</label>
    </div>
    <div class="user-box">
      <input type="text" name="email" required="" v-model="form.email" >
      <label>Email:</label>
   
      <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.email" >{{ errors.email }}</p>

    </div>
<br>

    <div v-for="empresa in empresas" :key="empresa.id">
      <input
        type="checkbox"
        :id="'presenca-' + empresa.id"
        :value="empresa.id"
        v-model="form.empresas">

      <label :for="'presenca-' + empresa.id">{{ empresa.razao }}</label>
    </div>

<br>
<div id="alinhar">
        <button type="submit">Atualizar</button>
        <Link href="/user/profile">Voltar</Link>
      </div>


  </form>
  
</div>
</div>

</template>

<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

//const selectedEmpresas = ref([]);

const props = defineProps({
    errors: Array,
    empresas: Object,
    user_editar: Object,
    empresasSelecionadas: Array,
    
})

//const selectedMembers = ref([]);

const form = useForm({
    nome: props.user_editar.nome,
    email: props.user_editar.email, 
    empresas: props.empresasSelecionadas || [],
    user_id: props.user_editar.id,
})

</script>


<style scoped>
   @import "..\Components\css\usuario-filial.css"; 
</style>