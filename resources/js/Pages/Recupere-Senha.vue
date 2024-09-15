<template lang="">
    <div id="geral" >
        <div class="login-box">
  <h2>Recupere Sua Senha</h2>

  <form  @submit.prevent="form.post('/recupere/senha')">


    <div  class="user-box">
      <input autocomplete="off" type="text" name="email" required="" v-model="form.email" >
      <label >Email:</label>
    <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.email" >{{ errors.email }}</p>

    </div>


  
<div id="alinhar-esquerda" >
<button type="submit">Enviar Codigo</button>
</div>
  </form>

  </div>
<br>
    </div>
</template>



<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    errors: Array,
});

const form = useForm({
  email: '',
});
</script>

<style scoped>
  @import "..\Components\css\usuario-filial.css";  
</style>