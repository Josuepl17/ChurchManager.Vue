<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template #subtabela>

<Link href="/cadastro/membro"><button style="padding: 5px;" >Inserir</button></Link>

        <form @submit.prevent="form.get('/')">
                <input v-model="form.pesquisa" type="search" name="pesquisa">
                <input type="submit" value="Buscar">

</form>

</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>


</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->

<template v-slot:conteudo>
        <table>
    <tr>
      <th class="remover">ID</th>
      <th>NOME</th>
      <th class="remover">ENDEREÇO</th>
      <th>FUNÇÃO</th>
      <th>TELEFONE</th>
      <th>PRESENÇA %</th>
      <th>X</th>
      <th>X</th>
    </tr>
    <tr v-for="membro in membros" :key="membro.id">
      <td class="remover" :style="{ backgroundColor: '#0A1626', color: 'white' }">{{ membro.id }}</td>
      <td>{{ membro.nome }}</td>
      <td class="remover">{{ membro.endereco }}</td>
      <td>{{ membro.funcao }}</td>
      <td>{{ membro.telefone }}</td>
      <td></td>
      <td id="inserir-verde">
        <form @submit.prevent="form.post('/inserir/dizimos')">
          <input type="hidden" name="membro_id" :value="form.membro_id">
          <input type="hidden" name="nome" :value="form.nome">
          <button type="submit" @click="handleClick(membro)">Inserir</button>
        </form>
      </td>
      <td id="X">
        <Link style="color: white; text-decoration: none;" :href="'/destroy/' + membro.id">X</Link>
      </td>
    </tr>
  </table>

</template> <!--conteudo-->

<!----------------------------------------------------------------------------------->
<template v-slot:valor-registrar>

</template> <!--valor-registrar-->

<!----------------------------------------------------------------------------------->

</layout>



</template>
<script>

import { useForm } from '@inertiajs/vue3'

export default {
  props: {
    membros: Array, // Recebe a lista de membros como propriedade
    qtdEventos: Number, // Recebe a quantidade de eventos como propriedade
  },
  setup() {
    const form = useForm({
      membro_id: null,
      nome: null,
      pesquisa: '',
    });

    // Define o método handleClick
    function handleClick(membro) {
      form.membro_id = membro.id;
      form.nome = membro.nome;
    }

    // Retorna form e handleClick para uso no template
    return {
      form,
      handleClick
    };
  }
}

</script>



<style>

    input[type=search] {
        width: 100%;
        /* Para o Input diminuir no momento em que a tela o espremer*/

    }

    #inserir-verde input[type=submit] {

        all: unset;

    }




    * {
        box-sizing: border-box;

    }

    
</style>

