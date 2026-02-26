<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <div class="card-wrapper">
      <div class="card">
        <div class="icon-box">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1z" />
          </svg>
        </div>

        <h1 class="card-title">Nova Filial</h1>
        <p class="card-subtitle">Cadastre uma nova igreja/filial no sistema</p>

        <form @submit.prevent="form.post('/cadastro/empresa/novo')">
          
          <div class="field">
            <label>Razão Social</label>
            <div class="input-wrapper">
              <input type="text" v-model="form.razao" required placeholder="Nome da Igreja" />
            </div>
          </div>

          <div class="field">
            <label>CNPJ</label>
            <div class="input-wrapper">
              <input type="text" v-model="form.cnpj" @input="formatCNPJ" required placeholder="00.000.000/0000-00" />
            </div>
            <p v-if="errors.cnpj" class="error-text">{{ errors.cnpj }}</p>
          </div>
          
          <div class="divider"></div>
          
          <div class="field">
            <label>Vincular Usuários Administradores</label>
            <div class="users-scroll">
              <div v-for="user in users" :key="user.id" class="user-item" @click="toggleUser(user.id)">
                <div class="checkbox-wrapper">
                  <input type="checkbox" :id="'user_id' + user.id" :value="user.id" v-model="form.user" @click.stop />
                  <div class="custom-checkbox"></div>
                </div>
                <span class="user-name">{{ user.nome }}</span>
              </div>
            </div>
          </div>

          <div class="form-footer">
            <Link href="/selecionar/filial" class="btn-back">Voltar</Link>
            <button type="submit" class="btn-primary">Adicionar Filial</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
  errors: Object,
  users: Array,
});

const form = useForm({
  razao: '',
  cnpj: '',
  user: [],
});

function toggleUser(id) {
    const index = form.user.indexOf(id);
    if (index > -1) form.user.splice(index, 1);
    else form.user.push(id);
}

function formatCNPJ() {
  let cnpj = form.cnpj.replace(/\D/g, '');
  if (cnpj.length > 14) cnpj = cnpj.slice(0, 14); 
  cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
  cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
  cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
  cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');
  form.cnpj = cnpj;
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; margin: 0; padding: 0; }

.auth-bg {
  min-height: 100vh; background: var(--fundo-principal, #0b1120);
  display: flex; align-items: center; justify-content: center;
  position: relative; overflow: hidden; font-family: 'Inter', sans-serif; padding: 40px 0;
}
.glow { position: absolute; width: 500px; height: 500px; border-radius: 50%; filter: blur(120px); pointer-events: none; }
.glow-top { top: -15%; left: -10%; background: rgba(37,99,235,0.22); }
.glow-bottom { bottom: -15%; right: -10%; background: rgba(99,102,241,0.2); }

.card-wrapper { width: 100%; max-width: 520px; padding: 0 20px; position: relative; z-index: 10; }
.card {
  background: var(--fundo-superior, rgba(255,255,255,0.04)); border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 28px; padding: 40px;
  backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
  box-shadow: 0 40px 100px rgba(0,0,0,0.6);
}

.icon-box {
  width: 58px; height: 58px; background: linear-gradient(135deg, #2563eb, #60a5fa);
  border-radius: 18px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 24px auto; box-shadow: 0 8px 24px rgba(37,99,235,0.4);
}
.icon-box svg { width: 28px; height: 28px; color: #fff; }

.card-title { font-size: 22px; font-weight: 900; color: var(--texto-primario, #fff); text-align: center; margin-bottom: 6px; }
.card-subtitle { font-size: 13px; color: var(--texto-secundario, #94a3b8); text-align: center; margin-bottom: 32px; font-weight: 500; }

form { display: flex; flex-direction: column; gap: 20px; }
.field { display: flex; flex-direction: column; gap: 8px; }
.field label { display: block; font-size: 10px; font-weight: 700; color: var(--texto-secundario, #cbd5e1); text-transform: uppercase; letter-spacing: 0.12em; }

.input-wrapper input {
  width: 100%; background: var(--fundo-inputs-botoes, rgba(255,255,255,0.05)); 
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 12px; padding: 13px 16px; color: var(--texto-primario, #fff); font-size: 14px;
  font-family: 'Inter', sans-serif; outline: none; transition: all 0.25s;
}
.input-wrapper input::placeholder { color: var(--texto-terciario, #475569); }
.input-wrapper input:focus { border-color: #3b82f6; background: rgba(59,130,246,0.05); box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }

.error-text { font-size: 11px; color: #f87171; margin-top: 4px; font-weight: 600; }
.divider { height: 1px; background: var(--borda-padrao, rgba(255,255,255,0.08)); margin: 10px 0; }

.users-scroll {
  max-height: 180px; overflow-y: auto; padding-right: 8px; display: flex; flex-direction: column; gap: 6px;
}
.users-scroll::-webkit-scrollbar { width: 4px; }
.users-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

.user-item {
  display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: 10px;
  background: rgba(255,255,255,0.02); border: 1px solid transparent; cursor: pointer; transition: all 0.2s;
}
.user-item:hover { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.05); }

.checkbox-wrapper { position: relative; width: 18px; height: 18px; }
.checkbox-wrapper input { opacity: 0; position: absolute; cursor: pointer; }
.custom-checkbox {
  position: absolute; top: 0; left: 0; height: 18px; width: 18px;
  background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 4px; transition: all 0.2s;
}
.checkbox-wrapper input:checked ~ .custom-checkbox { background: #3b82f6; border-color: #3b82f6; }
.custom-checkbox:after {
  content: ""; position: absolute; display: none; left: 6px; top: 2px;
  width: 5px; height: 10px; border: solid white; border-width: 0 2px 2px 0; transform: rotate(45deg);
}
.checkbox-wrapper input:checked ~ .custom-checkbox:after { display: block; }

.user-name { font-size: 13px; font-weight: 500; color: var(--texto-primario, #e2e8f0); }

.form-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 12px; }
.btn-back { font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; transition: color 0.2s; }
.btn-back:hover { color: #e2e8f0; }

.btn-primary {
  padding: 12px 24px; background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 12px; color: #fff; font-size: 14px; font-weight: 800;
  cursor: pointer; transition: all 0.2s; box-shadow: 0 6px 16px rgba(37,99,235,0.3);
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }
</style>