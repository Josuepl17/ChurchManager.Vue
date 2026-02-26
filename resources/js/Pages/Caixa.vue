<template>
  <div class="page">

    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
          </svg>
        </div>
        <div>
          <h1>Fechamentos de Caixa</h1>
          <p v-if="razao_empresa">{{ razao_empresa }}</p>
        </div>
      </div>
    </div>

    <!-- Lista de Fechamentos -->
    <div class="caixa-list">
      <div
        v-for="dado in dados"
        :key="dado.id"
        class="caixa-card"
      >
        <!-- Identificação -->
        <div class="caixa-id">
          <span class="caixa-badge">#{{ dado.id }}</span>
          <div class="caixa-periodo">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ dado.dataini }} até {{ dado.datafi }}
          </div>
        </div>

        <!-- Valores -->
        <div class="caixa-valores">
          <div class="valor-item">
            <span class="valor-label dizimos">Dízimos</span>
            <span class="valor-num">R$ {{ dado.totaldizimos }}</span>
          </div>
          <div class="valor-sep"></div>
          <div class="valor-item">
            <span class="valor-label ofertas">Ofertas</span>
            <span class="valor-num">R$ {{ dado.totalofertas }}</span>
          </div>
          <div class="valor-sep"></div>
          <div class="valor-item">
            <span class="valor-label despesas">Despesas</span>
            <span class="valor-num">R$ {{ dado.totaldespesas }}</span>
          </div>
        </div>

        <!-- Saldo e Status -->
        <div class="caixa-saldo">
          <span class="saldo-label">Saldo</span>
          <span class="saldo-valor">R$ {{ dado.saldo }}</span>
          <span class="badge-fechado">Fechado</span>
        </div>

        <!-- Ação -->
        <div class="caixa-acoes">
          <Link
            class="btn-excluir"
            :href="'/destroy/caixa/' + dado.id"
            title="Excluir Caixa"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </Link>
        </div>
      </div>

      <!-- Estado Vazio -->
      <div v-if="!dados || dados.length === 0" class="empty-state">
        <div class="empty-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
          </svg>
        </div>
        <p>Nenhum fechamento de caixa encontrado.</p>
      </div>
    </div>

    <!-- Rodapé com Saldo Total -->
    <div class="saldo-total">
      <span class="saldo-total-label">Saldo Total Geral</span>
      <span class="saldo-total-valor">R$ {{ saldo }},00</span>
    </div>

  </div>
</template>

<script>
import LayoutPrincipal from '../Components/Layout-Principal.vue';
export default { layout: LayoutPrincipal }
</script>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  dados: Object,
  saldo: Number,
  razao_empresa: String,
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

* { box-sizing: border-box; }

.page {
  display: flex;
  flex-direction: column;
  gap: 20px;
  font-family: 'Inter', sans-serif;
  min-height: 100%;
}

/* Header */
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
}
.header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.header-icon {
  width: 46px;
  height: 46px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
  flex-shrink: 0;
}
.header-icon svg { width: 22px; height: 22px; color: #fff; }
.header-left h1 {
  font-size: 18px;
  font-weight: 800;
  color: var(--texto-primario, #e2e8f0);
  margin: 0 0 2px 0;
  letter-spacing: -0.3px;
}
.header-left p {
  font-size: 12px;
  color: var(--texto-secundario, #64748b);
  margin: 0;
  font-weight: 500;
}

/* Lista */
.caixa-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

/* Card de Caixa */
.caixa-card {
  display: flex;
  align-items: center;
  gap: 16px;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-left: 3px solid #3b82f6;
  border-radius: 14px;
  padding: 16px 20px;
  transition: all 0.25s;
  flex-wrap: wrap;
}
.caixa-card:hover {
  border-color: rgba(59, 130, 246, 0.5);
  border-left-color: #3b82f6;
  background: var(--fundo-mais-superior, rgba(255,255,255,0.06));
  transform: translateX(3px);
}

/* Identificação */
.caixa-id {
  display: flex;
  flex-direction: column;
  gap: 6px;
  min-width: 140px;
  flex: 1;
}
.caixa-badge {
  font-size: 14px;
  font-weight: 800;
  color: #60a5fa;
  letter-spacing: 0.02em;
}
.caixa-periodo {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 12px;
  color: var(--texto-secundario, #64748b);
  font-weight: 500;
}
.caixa-periodo svg { width: 13px; height: 13px; flex-shrink: 0; }

/* Valores */
.caixa-valores {
  display: flex;
  align-items: center;
  gap: 16px;
  flex: 2;
  flex-wrap: wrap;
}
.valor-sep {
  width: 1px;
  height: 28px;
  background: var(--borda-padrao, rgba(255,255,255,0.08));
  flex-shrink: 0;
}
.valor-item {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.valor-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.valor-label.dizimos  { color: #34d399; }
.valor-label.ofertas  { color: #34d399; }
.valor-label.despesas { color: #f87171; }
.valor-num {
  font-size: 14px;
  font-weight: 700;
  color: var(--texto-primario, #e2e8f0);
}

/* Saldo */
.caixa-saldo {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 4px;
  flex: 1;
  min-width: 90px;
}
.saldo-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--texto-terciario, #475569);
}
.saldo-valor {
  font-size: 16px;
  font-weight: 800;
  color: #60a5fa;
}
.badge-fechado {
  font-size: 10px;
  font-weight: 700;
  background: rgba(59, 130, 246, 0.12);
  color: #60a5fa;
  border: 1px solid rgba(59, 130, 246, 0.25);
  border-radius: 999px;
  padding: 2px 8px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

/* Ações */
.caixa-acoes { flex-shrink: 0; }
.btn-excluir {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: rgba(239, 68, 68, 0.08);
  border: 1px solid rgba(239, 68, 68, 0.15);
  color: #f87171;
  transition: all 0.2s;
  cursor: pointer;
}
.btn-excluir svg { width: 16px; height: 16px; }
.btn-excluir:hover {
  background: rgba(239, 68, 68, 0.2);
  border-color: rgba(239, 68, 68, 0.4);
  transform: scale(1.05);
}

/* Empty State */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 14px;
  padding: 60px 20px;
  color: var(--texto-terciario, #475569);
}
.empty-icon {
  width: 56px;
  height: 56px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.empty-icon svg { width: 26px; height: 26px; }
.empty-state p { font-size: 14px; font-weight: 500; }

/* Saldo Total */
.saldo-total {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 12px;
  padding: 16px 20px;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 14px;
  margin-top: auto;
}
.saldo-total-label {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--texto-secundario, #64748b);
}
.saldo-total-valor {
  font-size: 22px;
  font-weight: 900;
  color: #34d399;
  letter-spacing: -0.5px;
}
</style>
