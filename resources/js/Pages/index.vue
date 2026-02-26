<template>
  <div class="page">
    
    <!-- Header -->
    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <div>
          <h1>Membros</h1>
          <p>Gerencie os membros da sua congregação</p>
        </div>
      </div>
      
      <div class="header-actions">
        <!-- Busca -->
        <form @submit.prevent="formPesquisa.get('/')" class="search-form">
          <div class="search-wrapper">
            <svg class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input v-model="formPesquisa.pesquisa" type="search" placeholder="Buscar por nome..." />
          </div>
        </form>

        <button class="btn-primary" @click="openModal = true">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Novo Membro
        </button>
      </div>
    </div>

    <!-- Lista de Membros -->
    <div class="members-grid">
      <div v-for="membro in membros" :key="membro.id" class="member-card">
        <div class="member-avatar">
          <span>{{ membro.nome.charAt(0) }}{{ membro.sobrenome.charAt(0) }}</span>
        </div>
        
        <div class="member-main">
          <div class="member-info">
            <span class="member-name">{{ membro.nome }} {{ membro.sobrenome }}</span>
            <span class="member-role">{{ membro.funcao || 'Membro' }}</span>
          </div>

          <div class="member-details">
            <div class="detail-item">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              {{ membro.telefone }}
            </div>
            <div class="detail-item">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              {{ membro.endereco }}
            </div>
          </div>
        </div>

        <div class="member-stats">
          <div class="stat-circle">
            <span class="stat-value">{{ (qtdEventos > 0 ? Math.round((membro.presenca / qtdEventos) * 100) : 0) }}%</span>
            <span class="stat-label">Presença</span>
          </div>
        </div>

        <div class="member-actions">
          <button @click="submitDizimoMembro(membro)" class="btn-dizimo" title="Registrar Dízimo">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </button>
          <Link class="btn-delete" :href="'/destroy/' + membro.id" method="get" as="button" title="Excluir Membro">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </Link>
        </div>
      </div>

      <div v-if="!membros || membros.length === 0" class="empty-state">
        <div class="empty-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <p>Nenhum membro encontrado.</p>
      </div>
    </div>

    <!-- Modal Cadastro -->
    <Modal v-model="openModal" titulo="Cadastrar Novo Membro" tamanho="md">
      <form @submit.prevent="submitMembro" class="formulario">
        <div class="form-row">
          <div class="grupo">
            <label class="rotulo">Nome</label>
            <input type="text" class="campo-texto" placeholder="Ex: João" v-model="formMembro.nome" required />
          </div>
          <div class="grupo">
            <label class="rotulo">Sobrenome</label>
            <input type="text" class="campo-texto" placeholder="Ex: Silva" v-model="formMembro.sobrenome" required />
          </div>
        </div>

        <div class="form-row">
          <div class="grupo">
            <label class="rotulo">Função</label>
            <select v-model="formMembro.funcao" class="campo-input">
              <option value="" disabled selected>Selecione uma função</option>
              <option value="MEMBRO">Membro</option>
              <option value="MUSICO">Músico</option>
              <option value="PASTOR">Pastor</option>
              <option value="OBREIRO">Obreiro</option>
            </select>
          </div>
          <div class="grupo">
            <label class="rotulo">Telefone</label>
            <input type="text" class="campo-texto" placeholder="(00) 00000-0000" @input="formatPhone" v-model="formMembro.telefone" required />
          </div>
        </div>

        <div class="grupo">
          <label class="rotulo">Endereço</label>
          <input type="text" class="campo-texto" placeholder="Rua, Número, Bairro" maxlength="30" v-model="formMembro.endereco" required />
        </div>

        <div class="acoes-formulario">
          <button type="button" class="btn-cancelar" @click="openModal=false">Cancelar</button>
          <button type="submit" class="btn-envio">Cadastrar Membro</button>
        </div>
      </form>
    </Modal>

  </div>
</template>

<script>
import LayoutPrincipal from '../Components/Layout-Principal.vue';
export default { layout: LayoutPrincipal }
</script>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '../Components/Modal.vue';

const props = defineProps({
  membros: Array,
  qtdEventos: Number,
  dados: String, 
});

const openModal = ref(false);

const formPesquisa = useForm({
  pesquisa: props.dados || '',
});

const formMembro = useForm({
    nome: '',
    sobrenome: '',
    funcao: '',
    endereco: '',
    telefone: '',
});

function submitDizimoMembro(membro) {
    router.get('/tela/dizimos', { busca: membro.nome });
}

function submitMembro() {
    formMembro.post('/inserir/membro', {
        onSuccess: () => {
            openModal.value = false;
            formMembro.reset();
        }
    });
}

function formatPhone(event) {
  let phone = event.target.value.replace(/\D/g, ''); 
  if (phone.length > 11) phone = phone.slice(0, 11);
  phone = phone.replace(/^(\d{2})(\d)/, '($1) $2');
  if (phone.length <= 13) phone = phone.replace(/(\d{4})(\d)/, '$1-$2');
  else phone = phone.replace(/(\d{5})(\d)/, '$1-$2');
  formMembro.telefone = phone;
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; }

.page {
  display: flex; flex-direction: column; gap: 24px;
  font-family: 'Inter', sans-serif; min-height: 100%; padding: 16px;
}

/* Header */
.page-header {
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
}
.header-left { display: flex; align-items: center; gap: 14px; }
.header-icon {
  width: 46px; height: 46px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border-radius: 14px; display: flex; align-items: center; justify-content: center;
  box-shadow: 0 6px 20px rgba(37,99,235,0.35); flex-shrink: 0;
}
.header-icon svg { width: 22px; height: 22px; color: #fff; }
.header-left h1 { font-size: 18px; font-weight: 800; color: var(--texto-primario, #e2e8f0); margin: 0 0 2px 0; }
.header-left p { font-size: 12px; color: var(--texto-secundario, #64748b); margin: 0; font-weight: 500; }

.header-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

/* Busca */
.search-form { min-width: 240px; }
.search-wrapper { position: relative; }
.search-icon { position: absolute; top: 50%; left: 12px; transform: translateY(-50%); width: 16px; height: 16px; color: #64748b; pointer-events: none; }
.search-wrapper input {
  width: 100%; background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 12px; padding: 10px 14px 10px 38px; color: var(--texto-primario); font-size: 13px; outline: none; transition: all 0.2s;
}
.search-wrapper input:focus { border-color: #3b82f6; background: rgba(255,255,255,0.06); box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }

.btn-primary {
  display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 12px; color: #fff;
  font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
  cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
.btn-primary svg { width: 16px; height: 16px; }
.btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }

/* Grid de Membros */
.members-grid { display: flex; flex-direction: column; gap: 10px; }

.member-card {
  display: flex; align-items: center; gap: 20px;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 16px; padding: 16px 20px; transition: all 0.2s;
}
.member-card:hover { border-color: rgba(59,130,246,0.3); background: rgba(255,255,255,0.06); transform: translateX(4px); }

.member-avatar {
  width: 48px; height: 48px; border-radius: 14px;
  background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(59,130,246,0.2));
  border: 1px solid rgba(59,130,246,0.2);
  display: flex; align-items: center; justify-content: center;
  color: #60a5fa; font-weight: 800; font-size: 14px; flex-shrink: 0;
}

.member-main { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 6px; }
.member-info { display: flex; flex-direction: column; }
.member-name { font-size: 15px; font-weight: 700; color: var(--texto-primario, #e2e8f0); }
.member-role { font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; }

.member-details { display: flex; gap: 20px; flex-wrap: wrap; }
.detail-item { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--texto-secundario, #94a3b8); }
.detail-item svg { width: 14px; height: 14px; color: #475569; }

.member-stats { padding: 0 20px; border-left: 1px solid var(--borda-padrao, rgba(255,255,255,0.08)); flex-shrink: 0; }
.stat-circle { display: flex; flex-direction: column; align-items: center; }
.stat-value { font-size: 18px; font-weight: 800; color: #3b82f6; }
.stat-label { font-size: 10px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; }

.member-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
.btn-dizimo, .btn-delete {
  width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.2s; border: 1px solid transparent;
}
.btn-dizimo { background: rgba(52,211,153,0.1); color: #34d399; }
.btn-dizimo:hover { background: rgba(52,211,153,0.2); border-color: rgba(52,211,153,0.3); }
.btn-delete { background: rgba(248,113,113,0.1); color: #f87171; border: none; }
.btn-delete:hover { background: rgba(248,113,113,0.2); color: #f87171; }
.btn-dizimo svg, .btn-delete svg { width: 18px; height: 18px; }

.empty-state {
  display: flex; flex-direction: column; align-items: center; gap: 12px; padding: 80px 20px; color: #475569;
}
.empty-icon { width: 52px; height: 52px; border-radius: 16px; background: rgba(255,255,255,0.04); display: flex; align-items: center; justify-content: center; }
.empty-icon svg { width: 26px; height: 26px; }

/* Formuário no Modal */
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
</style>
