<template>
  <div class="page">
    
    <!-- Header -->
    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
        </div>
        <div>
          <h1>Ofertas</h1>
          <p>Gerencie as ofertas recebidas pela igreja</p>
        </div>
      </div>
      
      <div class="header-actions">
        <!-- Filtro -->
        <form @submit.prevent="form.get('/filtrar/ofertas')" class="filter-form">
          <div class="filter-group">
            <input type="date" v-model="form.dataini" required />
            <span class="sep">até</span>
            <input type="date" v-model="form.datafi" required />
            <button type="submit" class="btn-filter" title="Filtrar">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </form>

        <button class="btn-primary" @click="openModal = true">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Registrar Oferta
        </button>
      </div>
    </div>

    <!-- Mensagens -->
    <div v-if="flash.sucesso" class="alert success">{{ flash.sucesso }}</div>
    <div v-if="flash.falha" class="alert error">{{ flash.falha }}</div>

    <!-- Lista -->
    <div class="finance-grid">
      <div v-for="oferta in dados.ofertas" :key="oferta.id" class="finance-card">
        <div class="card-status-pill success">Registrado</div>
        
        <div class="card-main">
          <div class="entry-info">
            <span class="entry-title">Oferta #{{ oferta.id }}</span>
            <span class="entry-date">{{ oferta.datereg }}</span>
          </div>

          <div class="entry-value success">
            <span class="currency">R$</span>
            <span class="amount">{{ oferta.valor }}</span>
          </div>
        </div>

        <div class="card-actions">
           <Link class="btn-delete" :href="'/destroy/ofertas/' + oferta.id" title="Excluir">
             <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
             </svg>
           </Link>
        </div>
      </div>

      <div v-if="!dados.ofertas || dados.ofertas.length === 0" class="empty-state">
        <p>Nenhuma oferta encontrada para este período.</p>
      </div>
    </div>
    
    <!-- Footer Total -->
    <div class="page-footer">
      <div class="total-box success">
        <span class="label">VALOR TOTAL</span>
        <span class="value">R$ {{dados.totalofertas}},00</span>
      </div>
    </div>

    <!-- Modal Registro -->
    <Modal v-model="openModal" titulo="Registrar Oferta" tamanho="sm">
      <form @submit.prevent="submitOferta" class="formulario">
        <div class="grupo">
          <label class="rotulo">Data de Registro</label>
          <input type="date" class="campo-input" v-model="formOferta.datereg" required />
        </div>
        <div class="grupo">
          <label class="rotulo">Valor (R$)</label>
          <input type="number" step="0.01" class="campo-input" placeholder="0.00" v-model="formOferta.valor" required />
        </div>

        <div class="acoes-formulario">
          <button type="button" class="btn-cancelar" @click="openModal=false">Cancelar</button>
          <button type="submit" class="btn-envio">Salvar Registro</button>
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
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '../Components/Modal.vue';

const props = defineProps({
  dados: Object,
  dataini: String,
  datafi: String,
  flash: Object,
});

const openModal = ref(false);

const form = useForm({
  dataini: props.dataini || '',
  datafi: props.datafi || '',
});

const formOferta = useForm({
  datereg: props.dados?.datanow || '',
  valor: '',
});

function submitOferta() {
    formOferta.post('/registrar/oferta', {
        onSuccess: () => {
            openModal.value = false;
            formOferta.reset('valor');
        }
    });
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
.page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
.header-left { display: flex; align-items: center; gap: 14px; }
.header-icon {
  width: 46px; height: 46px; background: linear-gradient(135deg, #ec4899, #d946ef);
  border-radius: 14px; display: flex; align-items: center; justify-content: center;
  box-shadow: 0 6px 20px rgba(236,72,153,0.3); flex-shrink: 0;
}
.header-icon svg { width: 22px; height: 22px; color: #fff; }
.header-left h1 { font-size: 18px; font-weight: 800; color: var(--texto-primario, #e2e8f0); margin: 0 0 2px 0; }
.header-left p { font-size: 12px; color: var(--texto-secundario, #64748b); margin: 0; font-weight: 500; }

.header-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

/* Filtro */
.filter-group {
  display: flex; align-items: center; gap: 8px; background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1)); border-radius: 12px; padding: 4px 8px;
}
.filter-group input {
  background: transparent; border: none; color: var(--texto-primario); font-size: 12px; font-family: 'Inter', sans-serif;
  outline: none; padding: 6px; width: 110px;
}
.filter-group .sep { font-size: 11px; color: #475569; font-weight: 600; }
.btn-filter { background: none; border: none; color: #3b82f6; cursor: pointer; display: flex; align-items: center; padding: 4px; }
.btn-filter svg { width: 18px; height: 18px; }

.btn-primary {
  display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;
  background: linear-gradient(135deg, #ec4899, #d946ef);
  border: none; border-radius: 12px; color: #fff; font-size: 13px; font-weight: 700;
  cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(236,72,153,0.3);
}
.btn-primary svg { width: 16px; height: 16px; }

/* Alerts */
.alert { padding: 12px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; }
.alert.success { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
.alert.error { background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }

/* Grid Cards */
.finance-grid { display: flex; flex-direction: column; gap: 10px; }
.finance-card {
  display: flex; align-items: center; gap: 20px;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 16px; padding: 14px 20px; transition: all 0.2s; position: relative;
}
.finance-card:hover { border-color: rgba(236,72,153,0.3); background: rgba(255,255,255,0.06); transform: translateX(4px); }

.card-status-pill {
  position: absolute; top: 12px; right: 60px; font-size: 9px; font-weight: 800;
  text-transform: uppercase; padding: 3px 8px; border-radius: 20px; letter-spacing: 0.05em;
}
.card-status-pill.success { background: rgba(16,185,129,0.15); color: #10b981; }

.card-main { flex: 1; display: flex; align-items: center; justify-content: space-between; padding-right: 40px; }
.entry-info { display: flex; flex-direction: column; gap: 2px; }
.entry-title { font-size: 14px; font-weight: 700; color: var(--texto-primario, #e2e8f0); }
.entry-date { font-size: 12px; color: #64748b; font-weight: 500; }

.entry-value { display: flex; align-items: baseline; gap: 4px; }
.entry-value .currency { font-size: 12px; font-weight: 600; }
.entry-value .amount { font-size: 18px; font-weight: 800; }
.entry-value.success { color: #10b981; }

.btn-delete {
  width: 36px; height: 36px; border-radius: 10px; background: rgba(248,113,113,0.1); color: #f87171;
  display: flex; align-items: center; justify-content: center; transition: all 0.2s;
}
.btn-delete:hover { background: rgba(248,113,113,0.2); }
.btn-delete svg { width: 18px; height: 18px; }

/* Empty */
.empty-state { text-align: center; padding: 40px; color: #475569; font-size: 14px; font-weight: 500; }

/* Footer */
.page-footer {
  margin-top: auto; padding: 20px; background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1)); border-radius: 16px; display: flex; justify-content: flex-end;
}
.total-box { display: flex; flex-direction: column; align-items: flex-end; }
.total-box .label { font-size: 11px; font-weight: 800; color: #64748b; letter-spacing: 0.1em; }
.total-box .value { font-size: 24px; font-weight: 900; }
.total-box.success .value { color: #10b981; }
</style>
