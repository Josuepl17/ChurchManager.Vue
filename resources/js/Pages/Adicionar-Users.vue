<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <div class="card-wrapper">
      <div class="card">
        <div class="icon-box">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </div>

        <h1 class="card-title">Adicionar Usuário</h1>
        <p class="card-subtitle">Registre um administrador e vincule-o às filiais</p>

        <form @submit.prevent="form.post('/cadastro/user/adicionar')">
          <div class="field">
            <label>Nome Completo</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <input type="text" v-model="form.user" required placeholder="Nome do usuário" />
            </div>
          </div>

          <div class="field">
            <label>E-mail</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <input type="email" v-model="form.email" required placeholder="email@igreja.com" />
            </div>
            <p v-if="errors?.email" class="field-error">{{ errors.email }}</p>
          </div>

          <div class="field">
            <label>Senha de Acesso</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              <input type="password" v-model="form.password" required placeholder="••••••••" />
            </div>
            <p v-if="errors?.password" class="field-error">{{ errors.password }}</p>
          </div>

          <div class="divider"></div>

          <div class="field">
            <label>Vincular a Filiais</label>
            <p v-if="errors?.empresa" class="field-error" style="margin-bottom: 8px;">{{ errors.empresa }}</p>
            <div class="empresa-list">
              <div
                v-for="empresa in empresas"
                :key="empresa.id"
                class="empresa-item"
                @click="toggleEmpresa(empresa.id)"
              >
                <input
                  type="checkbox"
                  :id="'empresa' + empresa.id"
                  :value="empresa.id"
                  v-model="form.empresas"
                  @click.stop
                />
                <label :for="'empresa' + empresa.id">{{ empresa.razao }}</label>
              </div>
            </div>
          </div>

          <div class="form-footer">
            <Link href="/user/profile" class="btn-back">← Voltar</Link>
            <button type="submit" class="btn-primary">Cadastrar Usuário</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ errors: Object, empresas: Object });

const form = useForm({ user: '', email: '', password: '', empresas: [] });

function toggleEmpresa(id) {
  const index = form.empresas.indexOf(id);
  if (index > -1) form.empresas.splice(index, 1);
  else form.empresas.push(id);
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
  border-radius: 28px; padding: 44px 40px;
  backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
  box-shadow: 0 40px 100px rgba(0,0,0,0.6);
}

.icon-box {
  width: 62px; height: 62px; background: linear-gradient(135deg, #2563eb, #60a5fa);
  border-radius: 20px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 24px auto; box-shadow: 0 8px 24px rgba(37,99,235,0.4);
}
.icon-box svg { width: 30px; height: 30px; color: #fff; }

.card-title { font-size: 24px; font-weight: 900; color: var(--texto-primario, #fff); text-align: center; margin-bottom: 6px; }
.card-subtitle { font-size: 13px; color: var(--texto-secundario, #94a3b8); text-align: center; margin-bottom: 32px; font-weight: 500; }

.field { margin-bottom: 18px; }
.field > label { display: block; font-size: 10px; font-weight: 700; color: var(--texto-secundario, #cbd5e1); text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px; }

.input-wrapper { position: relative; }
.input-icon { position: absolute; top: 50%; left: 16px; transform: translateY(-50%); width: 18px; height: 18px; color: var(--texto-terciario, #475569); pointer-events: none; transition: color 0.2s; }
.input-wrapper:focus-within .input-icon { color: #3b82f6; }
.input-wrapper input {
  width: 100%; background: var(--fundo-inputs-botoes, rgba(255,255,255,0.05)); 
  border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 12px; padding: 14px 16px 14px 46px; color: var(--texto-primario, #fff); font-size: 14px;
  font-family: 'Inter', sans-serif; outline: none; transition: all 0.25s;
}
.input-wrapper input::placeholder { color: var(--texto-terciario, #475569); }
.input-wrapper input:focus {
  border-color: #3b82f6; background: rgba(59,130,246,0.05);
  box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
}
.field-error { font-size: 11px; color: #f87171; margin-top: 6px; font-weight: 600; }

.divider { height: 1px; background: var(--borda-fina, rgba(255,255,255,0.07)); margin: 8px 0 20px 0; }

.empresa-list {
  background: var(--fundo-principal, rgba(255,255,255,0.03)); border: 1px solid var(--borda-padrao, rgba(255,255,255,0.07));
  border-radius: 12px; padding: 6px; max-height: 150px; overflow-y: auto;
}
.empresa-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px; border-radius: 8px; cursor: pointer; transition: background 0.2s;
}
.empresa-item:hover { background: var(--fundo-superior); }
.empresa-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #3b82f6; flex-shrink: 0; cursor: pointer; }
.empresa-item label { font-size: 14px; font-weight: 500; color: var(--texto-primario, #cbd5e1); cursor: pointer; flex: 1; }
.empresa-list::-webkit-scrollbar { width: 4px; }
.empresa-list::-webkit-scrollbar-thumb { background: var(--borda-padrao); border-radius: 10px; }

.form-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 28px; gap: 12px; }
.btn-back { font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; transition: color 0.2s; }
.btn-back:hover { color: var(--texto-primario, #e2e8f0); }

.btn-primary {
  padding: 13px 28px; background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 12px; color: #fff; font-size: 14px; font-weight: 800;
  font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.3s;
  box-shadow: 0 6px 20px rgba(37,99,235,0.3);
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-2px); }
</style>