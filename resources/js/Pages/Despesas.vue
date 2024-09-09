<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>
<form @submit.prevent="form.post('/filtrar/despesas')" >
    <input type="date" name="dataini" id="dataini"  v-model="form.dataini"  required>
    <input type="date" name="datafi" id="datafi" v-model="form.datafi"  required>
    <input style="width: 65px;" type="submit" value="Filtrar">
</form>
</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>
Despesas
</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->

<template v-slot:conteudo>
        <div id="tabela-dados">
    <table>
        <tr>
            <th style="width: 4%;">ID</th>
            <th>DATA</th>
            <th>DESCRIÇÃO</th>
            <th>VALOR</th>
            <th style="width: 4%;">X</th>
        </tr>

        <tr v-for="despesa in dados.despesas" :key="despesa.id" >
            <td style="background-color: var(--titulos); color:white">{{despesa.id}}</td>
            <td>{{despesa.datereg}}</td>
            <td>{{despesa.descricao}}</td>
            <td>R$ {{despesa.valor}}</td>
            <td id="X">
                <Link style="color: white; text-decoration: none;" :href="'/destroy/despesas/' + despesa.id">X</Link>
            </td>
        </tr>
    </table>
</div>


<div id="valor-total">
    <p>VALOR TOTAL: R$ <span style="color: red;  font-weight: bold;">{{dados.totaldespesas}}</span></p>

</div>

<div id="formulario-registro">
    <form class="id" @submit.prevent="form.post('/registrar/despesas/igreja')" >

        <input class="cad" type="date" name="data" id="data" v-model="form.datereg" autocomplete="off" required>

        <input  type="text" name="descricao" id="descricao"  v-model="form.descricao" placeholder="Descrição" >

        <input type="number" name="valor" step="0.01" id="valor" v-model="form.valor" autocomplete="off" required placeholder="Valor">

        <button type="submit">Registar Despesa</button>
    </form>
</div>
</template> <!--conteudo-->

<!----------------------------------------------------------------------------------->

</layout>



</template>
<script setup>

import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  dados: Object,
  dataini: String,
  datafi: String,
});


// Inicialize o formulário com os dados recebidos como props
const form = useForm({
descricao: '',
  datereg: '',
  valor: '',
  dataini: '' || props.dataini,
  datafi: '' || props.datafi,
});
</script>


<style lang="">

</style>
