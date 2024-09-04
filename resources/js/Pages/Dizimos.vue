<template>
        <Layout>
          <!-- Subtabela -->
          <template v-slot:subtabela>
            <form action="/inserir/dizimos" method="post">
              <input type="hidden" name="membro_id" value="{{Session()->get('membro_id')}}">
              <input type="hidden" name="nome" value="{{Session()->get('nome')}}">
              <input type="date" name="dataini" id="dataini" value="{{Session()->get('dataini_d')}}" required>
              <input type="date" name="datafi" id="datafi" value="{{Session()->get('datafi_d')}}" required>
              <input style="width: 65px;" type="submit" value="Filtrar">
            </form>
          </template>
      
          <!-- Título da Página -->
          <template v-slot:titulo-pagina>
            DIZIMOS
          </template>
      
          <!-- Conteúdo -->
          <template v-slot:conteudo>
            <div id="tabela-dados">
              <table>
                <tr>
                  <th style="width: 4%;">ID</th>
                  <th>DATA</th>
                  <th>VALOR</th>
                  <th style="width: 4%;">X</th>
                </tr>
                <tr v-for="dizimo in dizimos.reverse()" :key="dizimo.id">
                  <td style="background-color: var(--titulos); color: white">{{ dizimo.id }}</td>
                  <td>{{ formatDate(dizimo.data) }}</td>
                  <td>R${{ formatCurrency(dizimo.valor) }}</td>
                  <td id="X">
                    <form method="post" action="/dizimos/destoy/id">
                      <button class="excluir">X</button>
                      <input type="hidden" name="data" :value="dizimo.data">
                      <input type="hidden" name="id" :value="dizimo.id">
                    </form>
                  </td>
                </tr>
              </table>
            </div>
      
            <div id="valor-total">
              <p>VALOR TOTAL: R$ <span style="color: green; font-weight: bold;">{{ formatCurrency(totalDizimos) }}</span></p>
            </div>
      
            <div id="formulario-registro">
              <form action="/registrar/dizimo" method="post">
                @csrf
                <input type="hidden" name="membro_id" value="{{ Session()->get('membro_id') }}">
                <input type="hidden" name="nome" value="{{ Session()->get('nome') }}">
                <input type="date" name="data" id="data" :value="datanow" autocomplete="off" required>
                <input type="number" name="valor" step="0.01" id="valor" autocomplete="off" required placeholder="Valor:">
                <input type="hidden" name="dataini" value="{{ Session()->get('dataini_d') }}">
                <input type="hidden" name="datafi" value="{{ Session()->get('datafi_d') }}">
                <button type="submit">Registrar Dízimo</button>
              </form>
            </div>
          </template>
      
          <!-- Valor para Registrar (se necessário) -->
          <template v-slot:valor-registrar>
            <!-- Conteúdo aqui, se aplicável -->
          </template>
        </Layout>
      </template>
      
      <script>
      import Layout from '@/Components/Layout.vue';
      
      export default {
        components: {
          Layout,
        },
        data() {
          return {
            dizimos: [], // Seus dados de dízimos aqui
            totalDizimos: 0, // Valor total dos dízimos
            datanow: '', // Sua data atual aqui
          };
        },
        methods: {
          formatDate(date) {
            return this.$options.filters.formatDate(date); // Implemente seu filtro de formatação de data
          },
          formatCurrency(value) {
            return this.$options.filters.formatCurrency(value); // Implemente seu filtro de formatação de moeda
          },
        },
      };
      </script>
      
      <style scoped>
      /* Estilos específicos para este componente */
      </style>
      