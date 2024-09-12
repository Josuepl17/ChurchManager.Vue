<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>
<form @submit.prevent="form.get('/filtrar/ofertas')" >
    <input type="date" name="dataini" id="dataini"  v-model="form.dataini"  required>
    <input type="date" name="datafi" id="datafi" v-model="form.datafi"  required>
    <input style="width: 65px;" type="submit" value="Filtrar">
</form>
</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>
Ofertas
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
       
        <tr v-for="oferta in dados.ofertas" :key="oferta.id" >
            <td style="background-color: var(--titulos) ; color:white">{{oferta.id}}</td>
            <td>{{oferta.datereg}}</td>
            <td>R$ {{oferta.valor}} </td>
            <td id="X">
                <Link style="color: white; text-decoration: none;" :href="'/destroy/ofertas/' + oferta.id">X</Link>
            </td>
        </tr>

    </table>
</div>


<div id="valor-total">
    <p>VALOR TOTAL: R$ <span style="color: green; font-weight: bold;">{{dados.totalofertas}}</span></p>

</div>


<div id="formulario-registro">
    <form @submit.prevent="form.post('/registrar/oferta')" >
        <input type="date" name="data" id="data" v-model="form.datereg" autocomplete="off" required>
        <input type="number" step="0.01" name="valor" id="valor" v-model="form.valor" autocomplete="off" required placeholder="Valor">
        <button type="submit">Registar Oferta</button>
    </form>
</div>

<div v-if="flash.sucesso" class="flash-message" style="background-color: rgb(0, 77, 0);">
        <p>{{ flash.sucesso }}</p>
</div>

<div v-if="flash.falha" class="flash-message" style="background-color: red;">
    <p>{{ flash.falha }}</p>
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
  flash: Object,
});


// Inicialize o formulário com os dados recebidos como props
const form = useForm({
  datereg: '',
  valor: '',
  dataini: '' || props.dataini,
  datafi: '' || props.datafi,
});
</script>


<style lang="">
        
</style>
