<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>

</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>

        Formulario de Cadastro

</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->

<template v-slot:conteudo>
        <div class="conteudo" >
            <form @submit.prevent="form.post('/inserir/membro')">
    <input v-model="form.nome" type="text" name="nome" id="nome" autocomplete="off" required placeholder="Nome:">
    <input v-model="form.sobrenome" type="text" name="sobrenome" id="sobrenome" autocomplete="off" required placeholder="Sobrenome:">
    <input v-model="form.funcao" type="text" list="funcao" name="funcao" placeholder="Função">
    <datalist id="funcao">
      <option value="MEMBRO"></option>
      <option value="MUSICO"></option>
      <option value="PASTOR"></option>
      <option value="OBREIRO"></option>
    </datalist>
    <input v-model="form.endereco" type="text" name="endereco" id="endereco" autocomplete="off" required maxlength="30" placeholder="Endereço:">
    <input v-model="form.telefone" type="number" name="telefone" id="telefone" autocomplete="off" required maxlength="11" placeholder="Telefone:">
    <button type="submit">Cadastrar</button>
  </form>
</div>   
</template> <!--conteudo-->

<!----------------------------------------------------------------------------------->
<template v-slot:valor-registrar>

</template> <!--valor-registrar-->

<!----------------------------------------------------------------------------------->

</layout>

</template>


<script setup>

import { useForm } from '@inertiajs/vue3'

const form = useForm({
    nome: null,
    sobrenome: null, // olhar erro
    funcao: null,
    endereco: null,
    telefone: null,
})

</script>


<style>
/* Estilos para o formulário */
form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 55%;
    height: 90%;
    border: 1px solid black;
    border-radius: 10px;
    background-color: white;
}

input,
button {
    display: flex;
    width: 80%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    text-transform: uppercase;
}

button {
    background-color: rgb(0, 0, 66);
    color: #fff;
    cursor: pointer;

}

.conteudo {
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;

}

@media (max-width: 700px) {
    form {
        width: 97%;
        height: 69%;
    }
}
</style>
