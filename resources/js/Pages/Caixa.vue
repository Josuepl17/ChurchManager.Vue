<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>

</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>
Caixa
</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->        

<template v-slot:conteudo>
        <div id="tabela-dados" >
    <table>
        <tr>
            <th>ID</th>
            <th style="color: yellow;" >DATA INICIAL</th>
            <th style="color: yellow;" >DATA FINAL</th>
            <th style="color: rgb(0, 254, 0); " >DIZIMOS</th>
            <th style="color: rgb(0, 254, 0);" >OFERTAS</th>
            <th style="color:red;" >DESPESAS</th>
            <th style="color:blue;" >SALDO</th>
            <th >X</th>
        </tr>

    
        <tr v-for="dado in dados" :key="dado.id" >
            <td style="background-color: var(--titulos) ; color:white">{{dado.id}}</td>
            <td>{{dado.dataini}}</td>
            <td>{{dado.datafi}}</td>
            <td  >R$ {{dado.totaldizimos}}</td>
            <td>R$ {{dado.totalofertas}}</td>
            <td>R$ {{dado.totaldespesas}}</td>
            <td>R$ {{dado.saldo}}</td>
            <td id="X" >
                <Link style="color: white; text-decoration: none;" :href="'/destroy/caixa/' + dado.id">X</Link>
            </td>
        </tr>   

    </table>
   
</div>

<div id="valor-total">
     
            <p style="color: green; font-weight: bold;"> VALOR TOTAL: R$ {{saldo}}</p>
        </div>       
</template> <!--conteudo-->

        
</layout>



</template>
<script setup>

import { defineProps } from 'vue';

const props = defineProps({
  dados: Object,
  saldo: Number,
  razao_empresa: String,
});

</script>
<style lang="">
        
</style>
