<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <div class="card-wrapper">
      <div class="card">
        <div class="icon-box">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
        </div>

        <h1 class="card-title">Atualizar Conta</h1>
        <p class="card-subtitle">Atualize os dados e credenciais do seu usuário</p>

        <form @submit.prevent="form.post('/atualizar/user')">
          
          <div class="field">
            <label>Nome Completo</label>
            <div class="input-wrapper">
              <input type="text" v-model="form.user" required placeholder="Seu nome" />
            </div>
          </div>

          <div class="field">
            <label>E-mail</label>
            <div class="input-wrapper">
              <input type="email" v-model="form.email" required placeholder="email@exemplo.com" />
            </div>
            <p v-if="errors.email" class="error-text">{{ errors.email }}</p>
          </div>
          
          <div class="field">
            <label>Nova Senha</label>
            <div class="input-wrapper">
              <input type="password" v-model="form.password" required placeholder="Definir nova senha" />
            </div>
            <p v-if="errors.password" class="error-text">{{ errors.password }}</p>
          </div>

          <div class="form-footer">
            <Link href="/user/profile" class="btn-back">Cancelar</Link>
            <button type="submit" class="btn-primary">Salvar Alterações</button>
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
    user: Object,
});

const form = useForm({
    user: props.user.nome,
    email: props.user.email, 
    password: '',
});
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

.card-wrapper { width: 100%; max-width: 480px; padding: 0 20px; position: relative; z-index: 10; }
.card {
  background: var(--fundo-superior, rgba(255,255,255,0.04)); border: 1px solid var(--borda-padrao, rgba(255,255,255,0.1));
  border-radius: 28px; padding: 40px;
  backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
  box-shadow: 0 40px 100px rgba(0,0,0,0.6);
}

.icon-box {
  width: 58px; height: 58px; background: linear-gradient(135deg, #06b6d4, #3b82f6);
  border-radius: 18px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 24px auto; box-shadow: 0 8px 24px rgba(6,182,212,0.3);
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
.input-wrapper input:focus { border-color: #06b6d4; background: rgba(6,182,212,0.03); box-shadow: 0 0 0 3px rgba(6,182,212,0.12); }

.error-text { font-size: 11px; color: #f87171; margin-top: 4px; font-weight: 600; }

.form-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 12px; }
.btn-back { font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; transition: color 0.2s; }
.btn-back:hover { color: #e2e8f0; }

.btn-primary {
  padding: 12px 24px; background: linear-gradient(135deg, #2563eb, #0891b2);
  border: none; border-radius: 12px; color: #fff; font-size: 14px; font-weight: 800;
  cursor: pointer; transition: all 0.2s; box-shadow: 0 6px 16px rgba(37,99,235,0.3);
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }
</style>