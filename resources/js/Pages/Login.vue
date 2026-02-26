<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <a href="/cadastro/login" class="btn-register">Cadastrar-se</a>

    <div class="card-wrapper">
      <div class="card">

        <div class="icon-box">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>

        <h1 class="card-title">Bem-vindo</h1>
        <p class="card-subtitle">Faça login para acessar sua conta</p>

        <form @submit.prevent="form.post('/login/if')">

          <div class="field">
            <label for="email">Email ou Nome</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <input id="email" type="text" v-model="form.email" autocomplete="email" required placeholder="Seu email" />
            </div>
            <p v-if="errors?.email" class="field-error">{{ errors.email }}</p>
          </div>

          <div class="field">
            <label for="password">Senha</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              <input id="password" type="password" v-model="form.password" autocomplete="current-password" required placeholder="••••••••" />
            </div>
            <p v-if="errors?.password" class="field-error">{{ errors.password }}</p>
          </div>

          <div class="field-row">
            <label class="checkbox-label">
              <input type="checkbox" /> Lembrar-me
            </label>
            <a href="/esqueci/senha" class="link-forgot">Esqueceu a senha?</a>
          </div>

          <button type="submit" class="btn-primary">Entrar no Sistema</button>

        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ errors: Object });

const form = useForm({
  email: "",
  password: "",
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

.auth-bg {
  min-height: 100vh;
  background: #0b1120;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  font-family: 'Inter', sans-serif;
}

.glow {
  position: absolute;
  width: 600px;
  height: 600px;
  border-radius: 50%;
  filter: blur(130px);
  pointer-events: none;
}
.glow-top {
  top: -20%;
  left: -10%;
  background: rgba(37, 99, 235, 0.18);
}
.glow-bottom {
  bottom: -20%;
  right: -10%;
  background: rgba(99, 102, 241, 0.18);
}

.btn-register {
  position: absolute;
  top: 24px;
  right: 24px;
  padding: 10px 22px;
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 999px;
  color: rgba(255,255,255,0.75);
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  backdrop-filter: blur(10px);
  transition: all 0.3s;
  z-index: 10;
}
.btn-register:hover {
  background: rgba(255,255,255,0.08);
  color: #fff;
  border-color: rgba(255,255,255,0.35);
}

.card-wrapper {
  width: 100%;
  max-width: 520px;
  padding: 0 20px;
  position: relative;
  z-index: 10;
}

.card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 28px;
  padding: 36px 40px;
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.icon-box {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #2563eb, #60a5fa);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px auto;
  box-shadow: 0 8px 28px rgba(37, 99, 235, 0.4);
}
.icon-box svg { width: 28px; height: 28px; color: #fff; }

.card-title {
  font-size: 24px;
  font-weight: 900;
  color: #fff;
  text-align: center;
  margin-bottom: 6px;
  letter-spacing: -0.5px;
}
.card-subtitle {
  font-size: 13px;
  color: #94a3b8;
  text-align: center;
  margin-bottom: 28px;
  font-weight: 500;
}

.field {
  margin-bottom: 14px;
}
.field label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #cbd5e1;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  margin-bottom: 8px;
}

.input-wrapper {
  position: relative;
}
.input-icon {
  position: absolute;
  top: 50%;
  left: 18px;
  transform: translateY(-50%);
  width: 18px;
  height: 18px;
  color: #475569;
  pointer-events: none;
  transition: color 0.2s;
}
.input-wrapper:focus-within .input-icon { color: #60a5fa; }

.input-wrapper input {
  width: 100%;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.07);
  border-radius: 12px;
  padding: 13px 16px 13px 44px;
  color: #fff;
  font-size: 14px;
  font-family: 'Inter', sans-serif;
  outline: none;
  transition: all 0.25s;
}
.input-wrapper input::placeholder { color: #475569; }
.input-wrapper input:focus {
  border-color: rgba(96, 165, 250, 0.5);
  background: rgba(255, 255, 255, 0.08);
  box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
}

.field-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}
.checkbox-label {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 500;
  color: #94a3b8;
  cursor: pointer;
}
.checkbox-label input { accent-color: #3b82f6; width: 15px; height: 15px; }

.link-forgot {
  font-size: 14px;
  font-weight: 600;
  color: #60a5fa;
  text-decoration: none;
  transition: color 0.2s;
}
.link-forgot:hover { color: #93c5fd; }

.field-error {
  font-size: 12px;
  color: #f87171;
  margin-top: 6px;
}

.btn-primary {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none;
  border-radius: 13px;
  color: #fff;
  font-size: 15px;
  font-weight: 800;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
  letter-spacing: 0.02em;
}
.btn-primary:hover {
  transform: translateY(-2px) scale(1.01);
  box-shadow: 0 14px 40px rgba(37, 99, 235, 0.55);
}
.btn-primary:active { transform: scale(0.98); }
</style>
