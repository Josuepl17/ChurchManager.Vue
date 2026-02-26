<template>
  <div class="conteiner">
    <form @submit.prevent="form.post('/presenca/evento')">
      <div class="cabecalho" style="flex-wrap: wrap; margin-bottom: 1rem;">
        <h1 class="titulo-secundario">CHAMADA E PRESENÇA</h1>
        
        <div class="acoes" style="flex: 1; justify-content: flex-end;">
            <div class="grupo-filtros-data" style="margin-right: 1rem;">
                <input type="text" name="evento" class="campo-data" style="width: 250px;" placeholder="Nome do Evento (Ex: Culto de Domingo)" v-model="form.evento" required>
                <span class="separador-data">Data:</span>
                <input type="date" name="datereg" class="campo-data" v-model="form.datereg" required>
            </div>
            
            <button type="submit" class="btn-acessar" style="font-size: 1rem;">
                Salvar Presenças
            </button>
        </div>
      </div>

      <div class="lista-cards">
        <div class="card-info" v-for="membro in membros" :key="membro.id" :class="{'ativo': form.presenca.includes(membro.id)}" style="cursor: pointer;" @click="togglePresenca(membro.id)">
            <div class="card-conteudo" style="flex: 1; align-items: center; justify-content: center; max-width: 50px;">
                <input type="checkbox" :id="'presenca' + membro.id" :value="membro.id" v-model="form.presenca" style="width: 1.2rem; height: 1.2rem; accent-color: var(--cm-cor-solida); pointer-events: none;">
            </div>
            
            <div class="card-conteudo" style="flex: 3;">
                <div class="card-titulo">{{ membro.nome }} {{ membro.sobrenome }}</div>
                <div class="card-sub">{{ membro.funcao || 'Membro' }}</div>
            </div>
            
            <div class="card-conteudo" style="flex: 1; align-items: flex-end; margin-right: 1rem;">
                <span v-if="form.presenca.includes(membro.id)" class="status concluido">Presente</span>
                <span v-else class="status perigo">Falta</span>
            </div>
        </div>
        
        <div v-if="!membros || membros.length === 0" style="text-align:center; margin-top: 2rem; color: var(--texto-secundario);">
            Nenhum membro encontrado para chamada.
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import LayoutPrincipal from '../Components/Layout-Principal.vue';

export default {
    layout: LayoutPrincipal
}
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  membros: Array,
});

const form = useForm({
  datereg: '',
  evento: '',
  presenca: [],
});

function togglePresenca(id) {
    const index = form.presenca.indexOf(id);
    if (index > -1) {
        form.presenca.splice(index, 1);
    } else {
        form.presenca.push(id);
    }
}
</script>

<style scoped>
.card-info.ativo {
    border-color: var(--cm-cor-solida);
    background-color: rgba(59, 130, 246, 0.05);
}
</style>
