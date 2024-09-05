<template lang="">

  <layout>
  
  <!----------------------------------------------------------------------------------->
  <template v-slot:subtabela>
    <form action="/inserir/dizimos" method="post">   
    <input type="hidden" name="membro_id" value="{{Session()->get('membro_id')}}">
    <input type="hidden" name="nome" value="{{Session()->get('nome')}}">
    <input type="date" name="dataini" id="dataini" value="{{Session()->get('dataini_d')}}" required>
    <input type="date" name="datafi" id="datafi" value="{{Session()->get('datafi_d')}}" required>
    <input style="width: 65px;" type="submit" value="Filtrar">
</form>
  </template> <!--subtabela-->
  
  <!----------------------------------------------------------------------------------->
  
  <template v-slot:titulo-pagina>
  
    DIZIMOS {{props.nome}}
  
  </template> <!--titulo-pagina-->
  <!----------------------------------------------------------------------------------->        
  
  <template v-slot:conteudo>

    <div id="tabela-dados">
    <table>
      <tr>
        <th style="width: 4%;">ID</th>
        <th>DATA</th>
        <th>VALOR</th>
        <th style="width: 4%;">X</th>
      </tr>
      <tr v-for="dizimo in dados.dizimos" :key="dizimo.id">
        <td style="background-color: var(--titulos); color: white">{{ dizimo.id }}</td>
        <td>{{ dizimo.datereg }}</td>
        <td>R${{ dizimo.valor }}</td>
        <td id="X">
          <form @submit.prevent="form.post('/registrar/dizimo')">

            <button class="excluir">X</button>
          </form>
        </td>
      </tr>
    </table>
  </div> 

  <div id="valor-total">
    <p>VALOR TOTAL: R$ <span style="color: green; font-weight: bold;">1000</span></p>
  </div>


  <div id="formulario-registro">
    <form @submit.prevent="form.post('/registrar/dizimo')">
      <input type="date" name="datareg" v-model="form.datereg" autocomplete="off" required>
      <input type="number" name="valor" step="0.01" v-model="form.valor" autocomplete="off" required placeholder="Valor:">
      <button type="submit">Registrar Dízimo</button>
    </form>
  </div>
  </template> <!--conteudo-->   
  </layout>
  
  </template>

<script setup>

import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  dados: Object,
  membro_id: Number,
  nome: String,
  dataini: String,
  datafi: String,
});



// Inicialize o formulário com os dados recebidos como props
const form = useForm({
  membro_id: props.membro_id || '',
  nome: props.nome || '',
  datereg: '',
  valor: '',
  dataini: props.dataini || '',
  datafi: props.datafi || '',
});
</script>


  <style lang="">
          
  </style>
  