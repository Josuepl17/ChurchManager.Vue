<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template #subtabela>

<Link href="/cadastro/membro"><button style="padding: 5px;" >Inserir</button></Link>

        <form action="/" method="get">
                <input :value="dados || ''" type="search" name="pesquisa">

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
      <td>{{ calcularPresenca(membro.presenca) }}%</td>
      <td id="inserir-verde">
        <form action="/inserir/dizimos" method="post">
          <input type="hidden" name="membro_id" :value="membro.id">
          <input type="hidden" name="nome" :value="membro.nome">
          <input style="width: 100%; height: 100%; color: white;" type="submit" value="Inserir">
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


export default {


        props: {
                membros: Array, // Recebe a lista de membros como propriedade
                qtdEventos: Number, // Recebe a quantidade de eventos como propriedade
        },
        methods: {
                calcularPresenca(presenca) {
                        return this.qtdEventos > 0 ? Math.round((presenca / this.qtdEventos) * 100) : 0;
                },
        },

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

