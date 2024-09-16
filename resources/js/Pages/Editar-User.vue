<template lang="">

<div id="geral" >
    <div class="login-box">
  <h2>Edição de Usuario</h2>
  <form action="/editar/user" method="post" >

    <div class="user-box">
      <input type="text" name="nome" required="" >
      <label>Nome:</label>
    </div>
    <div class="user-box">
      <input type="text" name="email" required="" >
      <label>Email:</label>
   
        <p style="color: red; font-size:13px; margin-top:-18px;">{{ message }}</p>

    </div>
    <div class="user-box">
      <input type="hidden" name="user_id" id="user_id" >
    </div>

    <div v-for="empresa in empresas" :key="empresa.id">
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
        <button type="submit">Atualizar</button>
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

//const selectedEmpresas = ref([]);

const props = defineProps({
    errors: Array,
    empresas: Object,

})

const selectedMembers = ref([]);

const form = useForm({
    user: '',
    email: '', 
    password: '',
    empresas: selectedMembers.value,
})

</script>


<style scoped>
   @import "..\Components\css\usuario-filial.css"; 
</style>