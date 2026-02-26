<template>
  <div class="page">

    <!-- Header -->
    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
        <div>
          <h1>Resumo Financeiro</h1>
          <p v-if="dados.razao_empresa">{{ dados.razao_empresa }}</p>
        </div>
      </div>

      <div class="header-actions">
        <Link href="/" class="btn-outline">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Voltar
        </Link>

        <a
          target="_blank"
          :href="`/gerar/${dados.dataini}/${dados.datafi}`"
          class="btn-outline"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
          </svg>
          Gerar Relatório
        </a>

        <form @submit.prevent="form.post('/fechar')">
          <input type="hidden" name="totaldespesas" v-model="form.totaldespesas">
          <input type="hidden" name="totalofertas" v-model="form.totalofertas">
          <input type="hidden" name="saldo" v-model="form.saldo">
          <button type="submit" class="btn-danger">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
            Fechar Caixa
          </button>
        </form>
      </div>
    </div>

    <!-- Filtro de Data -->
    <div class="filtro-card">
      <div class="filtro-label">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
        </svg>
        <span>Filtrar Período</span>
      </div>
      <form @submit.prevent="form.post('/filtro/pdf')" class="filtro-form">
        <input type="date" name="dataini" v-model="form.dataini" required />
        <span class="filtro-sep">até</span>
        <input type="date" name="datafi" v-model="form.datafi" required />
        <button type="submit" class="btn-filtrar">Filtrar</button>
      </form>
    </div>

    <!-- Cards de KPI -->
    <div class="kpis">
      <div class="kpi-card">
        <div class="kpi-icon membros">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <div class="kpi-info">
          <span class="kpi-label">Membros</span>
          <span class="kpi-value">{{ dados.qtymembros }}</span>
        </div>
      </div>

      <div class="kpi-card">
        <div class="kpi-icon dizimos">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="kpi-info">
          <span class="kpi-label">Dízimos</span>
          <span class="kpi-value verde">R$ {{ dados.totaldizimos }}</span>
        </div>
      </div>

      <div class="kpi-card">
        <div class="kpi-icon ofertas">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
        </div>
        <div class="kpi-info">
          <span class="kpi-label">Ofertas</span>
          <span class="kpi-value verde">R$ {{ dados.totalofertas }}</span>
        </div>
      </div>

      <div class="kpi-card">
        <div class="kpi-icon despesas">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
          </svg>
        </div>
        <div class="kpi-info">
          <span class="kpi-label">Despesas</span>
          <span class="kpi-value vermelho">R$ {{ dados.totaldespesas }}</span>
        </div>
      </div>

      <div class="kpi-card kpi-destaque">
        <div class="kpi-icon saldo">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
          </svg>
        </div>
        <div class="kpi-info">
          <span class="kpi-label">Saldo Atual</span>
          <span class="kpi-value azul">R$ {{ saldo }}</span>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
  dados: Object,
  saldo: Number,
  dataini: String,
  datafi: String,
});

const form = useForm({
  dataini: props.dataini || '',
  datafi: props.datafi || '',
  totalofertas: props.dados.totalofertas,
  totaldespesas: props.dados.totaldespesas,
  saldo: props.saldo,
  totaldizimos: props.dados.totaldizimos,
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

* { box-sizing: border-box; }

.page {
  display: flex;
  flex-direction: column;
  gap: 16px;
  font-family: 'Inter', sans-serif;
  flex: 1;
  padding: 16px;
  background: var(--fundo-principal);
}

/* Header */
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  background: var(--cm-gradient-blue-dark);
  padding: 24px;
  border-radius: 20px;
  margin-bottom: 8px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.header-icon {
  width: 48px;
  height: 48px;
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
  flex-shrink: 0;
}
.header-icon svg { width: 24px; height: 24px; color: #fff; }

.header-left h1 {
  font-size: 20px;
  font-weight: 800;
  color: #ffffff; /* Títulos Brancos conforme pedido */
  margin: 0 0 2px 0;
  letter-spacing: -0.5px;
  text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.header-left p { font-size: 13px; color: rgba(255,255,255,0.7); margin: 0; font-weight: 500; }

.header-actions {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}
.header-actions form { margin: 0; }

.btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 12px;
  color: #ffffff;
  font-size: 13px;
  font-weight: 600;
  font-family: 'Inter', sans-serif;
  text-decoration: none;
  transition: all 0.25s;
  cursor: pointer;
  backdrop-filter: blur(5px);
}
.btn-outline svg { width: 16px; height: 16px; opacity: 0.9; }
.btn-outline:hover { 
  background: rgba(255, 255, 255, 0.2); 
  border-color: rgba(255, 255, 255, 0.3); 
  transform: translateY(-1px);
}

.btn-danger {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: #ef4444;
  border: none;
  border-radius: 12px;
  color: #ffffff;
  font-size: 13px;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  transition: all 0.25s;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}
.btn-danger svg { width: 16px; height: 16px; }
.btn-danger:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4); opacity: 0.95; }

/* Filtro */
.filtro-card {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 20px 24px;
  background: var(--fundo-card);
  border: 1px solid var(--borda-padrao);
  border-radius: 20px;
  flex-wrap: wrap;
  box-shadow: var(--sombra-card, 0 4px 15px rgba(0,0,0,0.05));
}
.filtro-label {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  font-weight: 800;
  color: var(--texto-secundario);
  text-transform: uppercase;
  letter-spacing: 0.12em;
}
.filtro-label svg { width: 18px; height: 18px; color: var(--cm-cor-solida); }
.filtro-form {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  flex: 1;
}
.filtro-form input[type="date"] {
  background: var(--fundo-principal);
  border: 1px solid var(--borda-padrao);
  border-radius: 12px;
  padding: 10px 16px;
  color: var(--texto-primario);
  font-size: 14px;
  font-family: 'Inter', sans-serif;
  outline: none;
  transition: all 0.2s;
}
.filtro-form input[type="date"]:focus {
  border-color: var(--cm-cor-solida);
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
.filtro-sep { font-size: 12px; color: var(--texto-terciario); font-weight: 700; }
.btn-filtrar {
  padding: 12px 28px;
  background: var(--cm-gradient-blue);
  border: none;
  border-radius: 12px;
  color: #fff;
  font-size: 14px;
  font-weight: 800;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  transition: all 0.25s;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}
.btn-filtrar:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3); }

/* KPIs */
.kpis {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 20px;
}

.kpi-card {
  display: flex;
  align-items: center;
  gap: 18px;
  padding: 24px 22px;
  background: var(--fundo-card);
  border: 1px solid var(--borda-padrao);
  border-radius: 22px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: var(--sombra-card, 0 4px 15px rgba(0,0,0,0.05));
}
.kpi-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.08);
  border-color: var(--cm-cor-solida);
}
.kpi-destaque {
  border: 1px solid var(--cm-cor-solida);
  background: rgba(37, 99, 235, 0.02);
}
html.theme-white .kpi-destaque { background: rgba(37, 99, 235, 0.05); }

.kpi-icon {
  width: 54px;
  height: 54px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.kpi-icon svg { width: 26px; height: 26px; }

.kpi-icon.membros  { background: rgba(99, 102, 241, 0.12); color: #6366f1; }
.kpi-icon.dizimos  { background: rgba(16, 185, 129, 0.12); color: #10b981; }
.kpi-icon.ofertas  { background: rgba(16, 185, 129, 0.12); color: #10b981; }
.kpi-icon.despesas { background: rgba(239, 68, 68, 0.12); color: #ef4444; }
.kpi-icon.saldo    { background: rgba(59, 130, 246, 0.12); color: #3b82f6; }

html.theme-white .kpi-icon.membros  { background: #eef2ff; color: #4338ca; }
html.theme-white .kpi-icon.dizimos  { background: #ecfdf5; color: #065f46; }
html.theme-white .kpi-icon.ofertas  { background: #ecfdf5; color: #065f46; }
html.theme-white .kpi-icon.despesas { background: #fef2f2; color: #991b1b; }
html.theme-white .kpi-icon.saldo    { background: #eff6ff; color: #1e40af; }

.kpi-info { display: flex; flex-direction: column; gap: 4px; min-width: 0; }
.kpi-label {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  color: var(--texto-terciario);
}
.kpi-value {
  font-size: 22px;
  font-weight: 900;
  color: var(--texto-primario);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  letter-spacing: -0.5px;
}
.kpi-value.verde   { color: #10b981; }
.kpi-value.vermelho { color: #ef4444; }
.kpi-value.azul     { color: #3b82f6; }

html.theme-white .kpi-value.verde   { color: #059669; }
html.theme-white .kpi-value.vermelho { color: #dc2626; }
html.theme-white .kpi-value.azul     { color: #2563eb; }
</style>
