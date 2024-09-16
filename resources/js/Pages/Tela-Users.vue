<template lang="">
    <div id="geral" >
        <div class="login-box">

<table>
                <tr>
                    <th style="width: 4%;">ID</th>
                    <th>USUARIOS</th>
                    <th style="width: 20%;" >X</th>

                </tr>
              
                <tr v-for="user in users" :key="user.id"  >
                    <td style="background-color: var(--titulos); color:white">{{user.id}}</td>
                    <td>{{user.nome}}</td>
                    <td class="tda" >
                        <Link :href="'/editar/user/' +  user.id">Editar</Link>
                    </td>
                </tr>

            </table>
            <br>
                
                <div id="alinhar" >
                  <Link id="botao-link"  href="/cadastro/login/novo">Adicionar Usuario</Link>
                  <br>
                  <Link id="botao-link" href="/">Menu Principal</Link>
                </div>

</div>
    </div>
</template>


<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    users: Object,
})

</script>



<style scoped >

html {
height: 100%;
}

#geral {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background: linear-gradient(#141e30, #243b55);
  width: 100%;
  height: 100vh;
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

#alinhar{
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





</style>