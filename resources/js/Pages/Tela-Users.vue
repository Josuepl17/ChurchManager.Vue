<template>
  <div class="page">
    <div class="page-header">
      <div class="header-left">
        <div class="header-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <div>
          <h1>Usuários</h1>
          <p>Gerencie os administradores do sistema</p>
        </div>
      </div>
      <div class="header-btns">
        <Link href="/" class="btn-back">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Voltar
        </Link>
        <Link href="/cadastro/login/novo" class="btn-primary">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          Adicionar Usuário
        </Link>
      </div>
    </div>

    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th class="th-id">ID</th>
            <th>Nome</th>
            <th class="th-acoes">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="td-id">{{ user.id }}</td>
            <td class="td-nome">{{ user.nome }}</td>
            <td class="td-acoes">
              <Link :href="'/editar/user/' + user.id" class="btn-editar">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar
              </Link>
            </td>
          </tr>
          <tr v-if="!users || users.length === 0">
            <td colspan="3" class="td-empty">Nenhum usuário encontrado.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({ users: Object });
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; }

.page { display: flex; flex-direction: column; gap: 20px; font-family: 'Inter', sans-serif; min-height: 100%; padding: 16px; }

.page-header {
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
}
.header-left { display: flex; align-items: center; gap: 14px; }
.header-icon {
  width: 46px; height: 46px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border-radius: 14px; display: flex; align-items: center; justify-content: center;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35); flex-shrink: 0;
}
.header-icon svg { width: 22px; height: 22px; color: #fff; }
.header-left h1 { font-size: 18px; font-weight: 800; color: var(--texto-primario, #e2e8f0); margin: 0 0 2px 0; }
.header-left p { font-size: 12px; color: var(--texto-secundario, #64748b); margin: 0; font-weight: 500; }

.header-btns { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

.btn-back {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 10px 16px;
  background: var(--fundo-superior, rgba(255,255,255,0.04));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 12px; color: var(--texto-secundario, #94a3b8);
  font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
  text-decoration: none; transition: all 0.2s;
}
.btn-back svg { width: 14px; height: 14px; transition: transform 0.2s; }
.btn-back:hover { color: var(--texto-primario, #e2e8f0); background: var(--fundo-principal-escuro, rgba(255,255,255,0.08)); border-color: var(--cm-cor-solida); }
.btn-back:hover svg { transform: translateX(-2px); }

.btn-primary {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 10px 18px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border-radius: 12px; color: #fff;
  font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
  text-decoration: none; transition: all 0.2s;
  box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
}
.btn-primary svg { width: 15px; height: 15px; }
.btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }

.table-card {
  background: var(--fundo-card, var(--fundo-superior, rgba(255,255,255,0.04)));
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
  border-radius: 16px; 
  overflow: hidden;
  box-shadow: var(--sombra-card, none);
}
table { width: 100%; border-collapse: collapse; }
thead tr {
  background: rgba(255,255,255,0.03);
  border-bottom: 1px solid var(--borda-padrao, rgba(255,255,255,0.08));
}
html.theme-white thead tr { background: rgba(0,0,0,0.02); }

th {
  padding: 14px 16px; text-align: left; font-size: 10px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 0.12em;
  color: var(--texto-terciario, #475569);
}
.th-id { width: 60px; }
.th-acoes { width: 140px; text-align: center; }

tbody tr {
  border-bottom: 1px solid var(--borda-fina, rgba(255,255,255,0.05));
  transition: background 0.2s;
}
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(255,255,255,0.03); }
html.theme-white tbody tr:hover { background: rgba(0,0,0,0.02); }

td { padding: 14px 16px; font-size: 14px; }
.td-id { color: #3b82f6; font-weight: 700; font-size: 12px; }
.td-nome { color: var(--texto-primario, #e2e8f0); font-weight: 500; }
.td-acoes { text-align: center; }
.td-empty { text-align: center; color: var(--texto-terciario, #475569); font-size: 14px; padding: 40px; }

.btn-editar {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 14px;
  background: rgba(37, 99, 235, 0.1);
  border: 1px solid rgba(37, 99, 235, 0.25);
  border-radius: 10px; color: #3b82f6;
  font-size: 12px; font-weight: 700; font-family: 'Inter', sans-serif;
  text-decoration: none; transition: all 0.2s;
}
.btn-editar svg { width: 14px; height: 14px; }
.btn-editar:hover { background: rgba(37, 99, 235, 0.2); border-color: rgba(37, 99, 235, 0.5); }
</style>