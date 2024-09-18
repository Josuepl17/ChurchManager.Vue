<template lang="">

<div id="geral">
  <div class="login-box">
      <h2>Entre</h2>
  
      <form @submit.prevent="form.post('/login/if')">
  
        <div class="user-box">
          <input   type="text" name="email" id="email" autocomplete="off"  v-model="form.email" required >
          <label>Nome:</label>
          <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.email" >{{ errors.email }}</p>
        </div>
          <br>
        <div class="user-box">
          <input autocomplete="off" v-model="form.password" type="password" name="password" id="password" required >
          <label>Senha:</label>
          <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.password" >{{ errors.password }}</p>
  
         <br>
         <br>
        </div>
  
        <div id="alinhar">
          <button type="submit">Login</button>
          <Link href="/esqueci/senha">Esqueci Minha Senha</Link>
        </div>
  
      </form>
  
  
  
    </div>
    <br>
  
    <Link id="cadastre-se" style="text-decoration: none;" href="/cadastro/login">Cadastrar-se</Link>
</div>

</template>







<script setup >
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    errors: Array,
});

const form = useForm({
  email: '',
  password: '',

});

</script>


<style scoped >

@import "..\Components\css\usuario-filial.css";

    #cadastre-se {
      position: absolute;
      right: 20px;
      top: 20px;
      border: 1px solid rgba(255, 255, 255, 0.503);
      padding: 08px 20px;
      color: white;
      border-radius: 10px;
      font-size: 16px;
      background-color: #141e30;
      
    }


    #cadastre-se:hover {

      background-color: #03e9f4;
      color: black;
      transition: 0.6s;
    }
</style>