<template>
  <div class="page">

    <!-- Header -->
    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <h1>Eventos e Presenças</h1>
          <p>Gerencie os eventos e registre a chamada</p>
        </div>
      </div>
      <button class="btn-primary" @click="abrirModal">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Registrar Presença
      </button>
    </div>

    <!-- Lista de Eventos -->
    <div class="eventos-list">
      <div v-for="evento in eventos" :key="evento.id" class="evento-card">
        <div class="evento-info">
          <span class="evento-nome">{{ evento.evento }}</span>
          <span class="evento-data">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ evento.datereg }}
          </span>
        </div>

        <div class="evento-stats">
          <div class="stat presentes">
            <span class="stat-label">Presentes</span>
            <span class="stat-valor">{{ evento.presentes }}</span>
          </div>
          <div class="stat-sep"></div>
          <div class="stat faltantes">
            <span class="stat-label">Faltantes</span>
            <span class="stat-valor">{{ evento.faltantes }}</span>
          </div>
        </div>

        <span class="badge-realizado">Realizado</span>
      </div>

      <div v-if="!eventos || eventos.length === 0" class="empty-state">
        <div class="empty-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <p>Nenhum evento registrado.</p>
      </div>
    </div>

    <!-- Modal de Presença -->
    <Teleport to="body">
      <div v-if="modalAberto" class="modal-overlay" @click.self="fecharModal">
        <div class="modal">

          <div class="modal-header">
            <div class="modal-title">
              <div class="modal-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
              </div>
              <div>
                <h2>Chamada e Presença</h2>
                <p>Registre a presença dos membros no evento</p>
              </div>
            </div>
            <button class="modal-close" @click="fecharModal">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="presencaForm.post('/presenca/evento', { onSuccess: () => fecharModal() })">
            
            <div class="modal-fields">
              <div class="field">
                <label>Nome do Evento</label>
                <div class="input-wrapper">
                  <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                  </svg>
                  <input type="text" v-model="presencaForm.evento" required placeholder="Ex: Culto de Domingo" />
                </div>
              </div>

              <div class="field">
                <label>Data do Evento</label>
                <input type="date" v-model="presencaForm.datereg" required class="input-date" />
              </div>
            </div>

            <div class="membros-section">
              <div class="membros-header">
                <span class="membros-label">Membros ({{ presencaForm.presenca.length }} presentes)</span>
                <button type="button" class="btn-todos" @click="marcarTodos">
                  {{ presencaForm.presenca.length === membros?.length ? 'Desmarcar Todos' : 'Marcar Todos' }}
                </button>
              </div>

              <div class="membros-list">
                <div
                  v-for="membro in membros"
                  :key="membro.id"
                  class="membro-item"
                  :class="{ ativo: presencaForm.presenca.includes(membro.id) }"
                  @click="togglePresenca(membro.id)"
                >
                  <input
                    type="checkbox"
                    :id="'m-' + membro.id"
                    :value="membro.id"
                    v-model="presencaForm.presenca"
                    @click.stop
                  />
                  <div class="membro-info">
                    <span class="membro-nome">{{ membro.nome }} {{ membro.sobrenome }}</span>
                    <span class="membro-funcao">{{ membro.funcao || 'Membro' }}</span>
                  </div>
                  <span v-if="presencaForm.presenca.includes(membro.id)" class="badge-presente">Presente</span>
                  <span v-else class="badge-falta">Falta</span>
                </div>

                <div v-if="!membros || membros.length === 0" class="membros-empty">
                  Nenhum membro encontrado.
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn-cancelar" @click="fecharModal">Cancelar</button>
              <button type="submit" class="btn-salvar">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Salvar Presenças
              </button>
            </div>
          </form>

        </div>
      </div>
    </Teleport>

  </div>
</template>

<script>
import LayoutPrincipal from '../Components/Layout-Principal.vue';
export default { layout: LayoutPrincipal }
</script>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  eventos: Object,
  membros: Array,
});

const modalAberto = ref(false);

const presencaForm = useForm({
  datereg: '',
  evento: '',
  presenca: [],
});

function abrirModal() {
  presencaForm.reset();
  modalAberto.value = true;
}

function fecharModal() {
  modalAberto.value = false;
}

function togglePresenca(id) {
  const index = presencaForm.presenca.indexOf(id);
  if (index > -1) presencaForm.presenca.splice(index, 1);
  else presencaForm.presenca.push(id);
}

function marcarTodos() {
  if (presencaForm.presenca.length === props.membros?.length) {
    presencaForm.presenca = [];
  } else {
    presencaForm.presenca = props.membros?.map(m => m.id) || [];
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; }

.page {
  display: flex; flex-direction: column; gap: 20px;
  font-family: 'Inter', sans-serif; min-height: 100%; padding: 16px;
}

/* Header */
.page-header {
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
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

.btn-primary {
  display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 12px; color: #fff;
  font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
  cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}
.btn-primary svg { width: 15px; height: 15px; }
.btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }

/* Lista de Eventos */
.eventos-list { display: flex; flex-direction: column; gap: 10px; }

.evento-card {
  display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-left: 3px solid #3b82f6;
  border-radius: 14px; padding: 16px 20px; transition: all 0.25s;
}
.evento-card:hover {
  border-color: rgba(59,130,246,0.4); border-left-color: #3b82f6;
  transform: translateX(3px);
}

.evento-info { display: flex; flex-direction: column; gap: 5px; flex: 2; min-width: 160px; }
.evento-nome { font-size: 15px; font-weight: 700; color: var(--texto-primario, #e2e8f0); }
.evento-data {
  display: flex; align-items: center; gap: 5px;
  font-size: 12px; color: var(--texto-secundario, #64748b); font-weight: 500;
}
.evento-data svg { width: 13px; height: 13px; flex-shrink: 0; }

.evento-stats { display: flex; align-items: center; gap: 16px; flex: 1; }
.stat { display: flex; flex-direction: column; gap: 2px; align-items: center; }
.stat-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--texto-terciario, #475569); }
.stat-valor { font-size: 18px; font-weight: 800; }
.presentes .stat-valor { color: #34d399; }
.faltantes .stat-valor { color: #f87171; }
.stat-sep { width: 1px; height: 28px; background: var(--borda-padrao, rgba(255,255,255,0.08)); }

.badge-realizado {
  font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
  background: rgba(59,130,246,0.1); color: #60a5fa;
  border: 1px solid rgba(59,130,246,0.2); border-radius: 999px; padding: 3px 10px;
}

.empty-state {
  display: flex; flex-direction: column; align-items: center; gap: 12px;
  padding: 60px 20px; color: var(--texto-terciario, #475569);
}
.empty-icon {
  width: 52px; height: 52px; border-radius: 16px;
  background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);
  display: flex; align-items: center; justify-content: center;
}
.empty-icon svg { width: 24px; height: 24px; }
.empty-state p { font-size: 14px; font-weight: 500; }

/* Modal */
.modal-overlay {
  position: fixed; inset: 0; z-index: 9999;
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(6px);
  display: flex; align-items: center; justify-content: center;
  padding: 20px;
  animation: fadeIn 0.2s ease;
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.modal {
  width: 100%; max-width: 600px; max-height: 90vh;
  background: var(--fundo-mais-superior, #111827);
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 24px;
  box-shadow: 0 40px 100px rgba(0,0,0,0.8);
  display: flex; flex-direction: column;
  overflow: hidden;
  animation: slideUp 0.25s ease;
}
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.modal-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 22px 24px;
  border-bottom: 1px solid var(--borda-fina, rgba(255,255,255,0.08));
  flex-shrink: 0;
}
.modal-title { display: flex; align-items: center; gap: 12px; }
.modal-icon {
  width: 42px; height: 42px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border-radius: 12px; display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 14px rgba(37,99,235,0.4);
}
.modal-icon svg { width: 20px; height: 20px; color: #fff; }
.modal-title h2 { font-size: 16px; font-weight: 800; color: var(--texto-primario); margin: 0 0 2px 0; }
.modal-title p { font-size: 12px; color: var(--texto-secundario); margin: 0; }

.modal-close {
  width: 32px; height: 32px; border-radius: 8px;
  background: var(--fundo-superior, rgba(255,255,255,0.05));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  color: var(--texto-secundario); display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.2s;
}
.modal-close svg { width: 16px; height: 16px; }
.modal-close:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.3); color: #f87171; }

/* Campos do modal */
.modal-fields {
  display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
  padding: 20px 24px 0 24px; flex-shrink: 0;
}
@media (max-width: 480px) { .modal-fields { grid-template-columns: 1fr; } }

.field { display: flex; flex-direction: column; gap: 8px; }
.field label { font-size: 10px; font-weight: 700; color: var(--texto-secundario); text-transform: uppercase; letter-spacing: 0.12em; }

.input-wrapper { position: relative; }
.input-icon { position: absolute; top: 50%; left: 14px; transform: translateY(-50%); width: 16px; height: 16px; color: var(--texto-terciario); pointer-events: none; transition: color 0.2s; }
.input-wrapper:focus-within .input-icon { color: #60a5fa; }
.input-wrapper input, .input-date {
  width: 100%; background: var(--fundo-principal, rgba(255,255,255,0.05)); border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 10px; padding: 12px 14px 12px 40px; color: var(--texto-primario); font-size: 13px;
  font-family: 'Inter', sans-serif; outline: none; transition: all 0.2s;
}
.input-date { padding: 12px 14px; }
.input-wrapper input::placeholder { color: var(--texto-terciario); }
.input-wrapper input:focus, .input-date:focus {
  border-color: rgba(96,165,250,0.5); background: var(--fundo-superior);
  box-shadow: 0 0 0 3px rgba(96,165,250,0.1);
}

/* Lista de membros */
.membros-section { display: flex; flex-direction: column; flex: 1; overflow: hidden; padding: 16px 24px 0 24px; }

.membros-header {
  display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;
}
.membros-label { font-size: 10px; font-weight: 700; color: var(--texto-terciario); text-transform: uppercase; letter-spacing: 0.12em; }
.btn-todos {
  font-size: 11px; font-weight: 700; color: #60a5fa; background: rgba(96,165,250,0.08);
  border: 1px solid rgba(96,165,250,0.2); border-radius: 8px; padding: 4px 12px;
  cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif;
}
.btn-todos:hover { background: rgba(96,165,250,0.15); }

.membros-list {
  overflow-y: auto; flex: 1; display: flex; flex-direction: column; gap: 4px;
  max-height: 280px; padding-right: 4px;
}
.membros-list::-webkit-scrollbar { width: 5px; }
.membros-list::-webkit-scrollbar-thumb { background: var(--borda-padrao, rgba(255,255,255,0.1)); border-radius: 10px; }

.membro-item {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 12px; border-radius: 10px;
  border: 1px solid transparent;
  cursor: pointer; transition: all 0.2s;
}
.membro-item:hover { background: var(--fundo-superior, rgba(255,255,255,0.04)); border-color: var(--borda-fina, rgba(255,255,255,0.06)); }
.membro-item.ativo { background: rgba(59,130,246,0.07); border-color: rgba(59,130,246,0.25); }

.membro-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #3b82f6; flex-shrink: 0; cursor: pointer; }
.membro-info { display: flex; flex-direction: column; gap: 2px; flex: 1; min-width: 0; }
.membro-nome { font-size: 13px; font-weight: 600; color: var(--texto-primario); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.membro-funcao { font-size: 11px; color: var(--texto-terciario); font-weight: 500; }

.badge-presente {
  font-size: 10px; font-weight: 700; background: rgba(52,211,153,0.12);
  color: #10b981; border: 1px solid rgba(52,211,153,0.25);
  border-radius: 999px; padding: 2px 8px; white-space: nowrap; flex-shrink: 0;
}
.badge-falta {
  font-size: 10px; font-weight: 700; background: rgba(248,113,113,0.1);
  color: #ef4444; border: 1px solid rgba(248,113,113,0.2);
  border-radius: 999px; padding: 2px 8px; white-space: nowrap; flex-shrink: 0;
}
.membros-empty { text-align: center; padding: 30px; font-size: 13px; color: var(--texto-terciario); }

/* Footer do modal */
.modal-footer {
  display: flex; align-items: center; justify-content: flex-end; gap: 10px;
  padding: 16px 24px;
  border-top: 1px solid var(--borda-fina, rgba(255,255,255,0.08));
  flex-shrink: 0; margin-top: 16px;
}
.btn-cancelar {
  padding: 10px 18px; background: var(--fundo-superior, rgba(255,255,255,0.04)); border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 10px; color: var(--texto-secundario); font-size: 13px; font-weight: 600;
  font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.2s;
}
.btn-cancelar:hover { background: var(--fundo-mais-superior); color: var(--texto-primario); }

.btn-salvar {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 10px 20px; background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 10px; color: #fff; font-size: 13px; font-weight: 700;
  font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.2s;
  box-shadow: 0 4px 14px rgba(37,99,235,0.4);
}
.btn-salvar svg { width: 15px; height: 15px; }
.btn-salvar:hover { opacity: 0.88; transform: translateY(-1px); }
</style>
