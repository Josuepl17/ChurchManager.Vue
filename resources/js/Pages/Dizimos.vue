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
      <tr v-for="dizimo in dizimos" :key="dizimo.id">
        <td style="background-color: var(--titulos); color: white">{{ dizimo.id }}</td>
        <td>{{ formatDate(dizimo.data) }}</td>
        <td>R${{ formatCurrency(dizimo.valor) }}</td>
        <td id="X">
          <form @submit.prevent="deleteDizimo(dizimo.id)">
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
    <form @submit.prevent="registrarDizimo">
      <input type="hidden" name="membro_id" :value="membroId">
      <input type="hidden" name="nome" :value="nome">
      <input type="date" name="data" v-model="data" autocomplete="off" required>
      <input type="number" name="valor" step="0.01" v-model="valor" autocomplete="off" required placeholder="Valor:">
      <input type="hidden" name="dataini" :value="dataini">
      <input type="hidden" name="datafi" :value="datafi">
      <button type="submit">Registrar Dízimo</button>
    </form>
  </div>

  </template> <!--conteudo-->



          
  </layout>
  
  
  
  </template>
  <script>
  

  
  

  </script>


  <style lang="">
          
  </style>
  