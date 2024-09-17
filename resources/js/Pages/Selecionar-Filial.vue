<template lang="">
    <div id="geral">
        <div class="login-box">

<table>
    <tr>
        <th>ID</th>
        <th>FILIAL</th>
        <th>SELECIONAR</th>
    </tr>

    <tr v-for="empresa in empresas" :key="empresa.id" >
        <td>{{ empresa.id }}</td>
        <td>{{ empresa.razao }}</td>
        <td class="tda" >
            <Link :href="'/entrar/' + empresa.id ">Entrar</Link>
        </td>
    </tr>


</table>
<br>
<div id="alinhar" >

  
  <Link id="botao-link" style="text-decoration: none;" href="/cadastrar/empresas">Cadastro Nova Filial</Link>
  <br>

  <Link id="botao-link" style="text-decoration: none;" href="/">Menu Principal</Link>
</div>


</div>
    </div>
</template>


<script setup >
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    empresas: Object,
})

</script>
<style scoped>
  
   html {
  height: 100%;
}

#geral{
  background: linear-gradient(#141e30, #243b55);
  height: 100vh;
  width: 100%;
  margin:0;
  padding:0;
  font-family: sans-serif;

}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 600px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;


}





@media(max-width: 1000px){

  .login-box {
  transform: scale(1.5);
  top: 30%;
  left: 17%;
}

}

th, td {
  color: white;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.567);
  padding: 5px;


}

td{
  background-color: white;
  color: black;
}

.tda:hover{
  background: rgba(0,0,0,.5);
  transition: 0.6s;
}

a:hover{
  color: white;
}

a{
  text-decoration: none;
  color: black;
  display: block;
  width: 100%;
  height: 100%;
}

table{
  border-collapse: collapse;
  width: 100%;
}

p{
  color: black;
}

a{
    color: white;
    text-decoration: none;
    text-align: end;
    
}



.tda:hover{
  background: green;
  transition: 0.6s;
  color: white;

}

.tda{
    width: 10%;
    background: rgba(0, 128, 0, 0.577);
    
}

.tda a {
  text-align: center;
}

#cadastro{
  width: 100%;
  display: flex;
  justify-content: flex-end;
}


#botao-link{
  all: unset;
  border: 1px solid rgba(255, 255, 255, 0.503);
  padding: 08px 20px;
  color: white;
  border-radius: 10px;
  font-size: 14px;
  background-color: #141e30;
 margin-right: 6px
}

#botao-link:hover{

  background-color: #03e9f4;
  color: black;
  transition: 0.6s;
}

#alinhar{
  display: flex;
  justify-content: flex-end;
}
</style>