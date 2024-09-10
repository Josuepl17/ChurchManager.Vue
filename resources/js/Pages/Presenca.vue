<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>

</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>
Presença
</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->

<template v-slot:conteudo>
    <form @submit.prevent="form.post('/presenca/evento')">

        <div id="header">
            <input type="text" name="evento" id="evento" placeholder="Evento" v-model="form.evento">
            <input type="date" name="datereg" id="datereg" v-model="form.datereg" >
            <input type="submit" value="Enviar">
            
        </div>

    </form>

    <div id="tabela-dados">
        <table>
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>PRESENÇA</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="membro in membros" :key="membro.id">
                    <td>{{membro.nome}} {{membro.sobrenome}}</td>
                    <td>
                        <input
                  type="checkbox"
                  :id="'presenca' + membro.id"
                  :value="membro.id"
                  v-model="form.presenca"
                >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 20px;">
    </div>
</template>


<!----------------------------------------------------------------------------------->

</layout>
</template>


<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  membros: Array, // Corrigido para Array
});

const selectedMembers = ref([]);

const form = useForm({
  datereg: '',
  evento: '',
  presenca: selectedMembers.value
});


</script>





<style scoped>
#header {
    display: flex;
    justify-content: center;
    height: 05%;
    width: 100%;
    margin-top: 20px;
}

/* Estilos para o cabeçalho do formulário */
#header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

#header input[type="text"],
#header input[type="date"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#header input[type="text"] {
    width: 300px;
}

#header input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}


/* Estilos para a tabela */
#tabela-dados {
    width: 45%;
    overflow-x: auto;
    margin-top: 20px;
    margin: auto;
    height: 75%;
}

#tabela-dados table {
    width: 100%;
    border-collapse: collapse;
}

#tabela-dados th,
#tabela-dados td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#tabela-dados th {
    position: sticky;
    top: -1px;
    z-index: 999;
}
</style>
