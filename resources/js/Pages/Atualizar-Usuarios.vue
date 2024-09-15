<template lang="">
    <div id="geral" >
        <div class="login-box">
        <h2>Atualize Sua Conta</h2>
        
        <form @submit.prevent="form.post('/atualizar/user')" >
  
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
                <label>Nova Senha:</label>

                <p style="color: red; font-size:13px; margin-top:-18px;" v-if="errors.password" >{{ errors.password }}</p>

            </div>

            <button type="submit">Atualizar</button>

        </form>

    </div>
    </div>
</template>




<script setup >
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    errors: Array,
    user: Object,
})

const form = useForm({
    user: props.user.nome,
    email: props.user.email, 
    password: '',

})
</script>


<style scoped>
  @import "..\Components\css\usuario-filial.css";  
</style>