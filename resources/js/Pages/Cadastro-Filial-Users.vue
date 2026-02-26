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

        <h1 class="card-title">Criar Conta Corporativa</h1>
        <p class="card-subtitle">Cadastre seus dados e registre sua filial inaugural</p>

        <form @submit.prevent="form.post('/cadastro/usuario')">

          <div class="section-label">
            <span class="section-bar blue"></span>
            <span>Dados do Administrador</span>
          </div>

          <div class="field-grid">
            <div class="field">
              <label>Nome Completo</label>
              <div class="input-wrapper">
                <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <input type="text" v-model="form.nome" required placeholder="Seu nome completo" />
              </div>
            </div>

            <div class="field">
              <label>Email Profissional</label>
              <div class="input-wrapper">
                <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input type="email" v-model="form.email" required placeholder="email@exemplo.com" />
              </div>
              <p v-if="errors?.email" class="field-error">{{ errors.email }}</p>
            </div>
          </div>

          <div class="field">
            <label>Senha de Acesso</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              <input type="password" v-model="form.password" required placeholder="Mínimo 8 caracteres" />
            </div>
            <p v-if="errors?.password" class="field-error">{{ errors.password }}</p>
          </div>

          <div class="section-label" style="margin-top: 36px;">
            <span class="section-bar cyan"></span>
            <span>Dados da Filial</span>
          </div>

          <div class="field-grid">
            <div class="field">
              <label>Razão Social da Igreja</label>
              <div class="input-wrapper">
                <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1z" />
                </svg>
                <input type="text" v-model="form.razao" required placeholder="Nome da Igreja" />
              </div>
            </div>

            <div class="field">
              <label>CNPJ</label>
              <div class="input-wrapper">
                <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <input type="text" v-model="form.cnpj" @input="formatCNPJ" required placeholder="00.000.000/0000-00" />
              </div>
              <p v-if="errors?.cnpj" class="field-error">{{ errors.cnpj }}</p>
            </div>
          </div>

          <div class="form-footer">
            <a href="/login" class="link-login">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Já tem conta? Fazer Login
            </a>
            <button type="submit" class="btn-primary">Concluir Cadastro</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ errors: Object });

const form = useForm({
  nome: "",
  email: "",
  password: "",
  razao: "",
  cnpj: "",
});

function formatCNPJ() {
  let cnpj = form.cnpj.replace(/\D/g, "");
  if (cnpj.length > 14) cnpj = cnpj.slice(0, 14);
  cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
  cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
  cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
  cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
  form.cnpj = cnpj;
}
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
  padding: 40px 0;
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
  background: rgba(6, 182, 212, 0.15);
}

.card-wrapper {
  width: 100%;
  max-width: 660px;
  padding: 0 20px;
  position: relative;
  z-index: 10;
}

.card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 28px;
  padding: 36px 44px;
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.icon-box {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #2563eb, #06b6d4);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px auto;
  box-shadow: 0 8px 28px rgba(37, 99, 235, 0.35);
}
.icon-box svg { width: 28px; height: 28px; color: #fff; }

.card-title {
  font-size: 22px;
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

.section-label {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 14px;
  font-size: 14px;
  font-weight: 700;
  color: #e2e8f0;
}
.section-bar {
  width: 4px;
  height: 18px;
  border-radius: 999px;
  flex-shrink: 0;
}
.section-bar.blue { background: #3b82f6; }
.section-bar.cyan { background: #06b6d4; }

.field-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
@media (max-width: 640px) {
  .field-grid { grid-template-columns: 1fr; }
  .card { padding: 36px 24px; }
}

.field { margin-bottom: 14px; }
.field label {
  display: block;
  font-size: 10px;
  font-weight: 700;
  color: #cbd5e1;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  margin-bottom: 6px;
}

.input-wrapper { position: relative; }
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
  padding: 12px 16px 12px 44px;
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

.field-error { font-size: 12px; color: #f87171; margin-top: 6px; }

.form-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 24px;
  gap: 16px;
  flex-wrap: wrap;
}

.link-login {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  font-weight: 600;
  color: #64748b;
  text-decoration: none;
  transition: color 0.2s;
}
.link-login svg { width: 15px; height: 15px; transition: transform 0.2s; }
.link-login:hover { color: #e2e8f0; }
.link-login:hover svg { transform: translateX(-3px); }

.btn-primary {
  padding: 13px 28px;
  background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none;
  border-radius: 12px;
  color: #fff;
  font-size: 14px;
  font-weight: 800;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
  white-space: nowrap;
}
.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 40px rgba(37, 99, 235, 0.55);
}
.btn-primary:active { transform: scale(0.98); }
</style>