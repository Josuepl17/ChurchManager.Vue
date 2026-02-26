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

        <h1 class="card-title">Cadastrar Membro</h1>
        <p class="card-subtitle">Insira as informações básicas para adicionar um novo membro</p>

        <form @submit.prevent="form.post('/inserir/membro')">
          <div class="form-row">
            <div class="field">
              <label>Nome</label>
              <div class="input-wrapper">
                <input v-model="form.nome" type="text" autocomplete="off" required placeholder="Ex: João" />
              </div>
            </div>
            <div class="field">
              <label>Sobrenome</label>
              <div class="input-wrapper">
                <input v-model="form.sobrenome" type="text" autocomplete="off" required placeholder="Ex: Silva" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label>Função</label>
              <div class="input-wrapper">
                <select v-model="form.funcao" required>
                  <option value="" disabled selected>Selecione</option>
                  <option value="MEMBRO">Membro</option>
                  <option value="MUSICO">Músico</option>
                  <option value="PASTOR">Pastor</option>
                  <option value="OBREIRO">Obreiro</option>
                </select>
              </div>
            </div>
            <div class="field">
              <label>Telefone</label>
              <div class="input-wrapper">
                <input v-model="form.telefone" @input="formatPhone" type="text" autocomplete="off" required placeholder="(00) 00000-0000" />
              </div>
            </div>
          </div>

          <div class="field">
            <label>Endereço</label>
            <div class="input-wrapper">
              <input v-model="form.endereco" type="text" autocomplete="off" required maxlength="30" placeholder="Rua, Número, Bairro" />
            </div>
          </div>

          <div class="form-footer">
            <Link href="/" class="btn-back">← Voltar para Membros</Link>
            <button type="submit" class="btn-primary">Cadastrar Membro</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import LayoutPrincipal from '../Components/Layout-Principal.vue';
export default { layout: LayoutPrincipal }
</script>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    nome: '',
    sobrenome: '',
    funcao: '',
    endereco: '',
    telefone: '',
});

function formatPhone(event) {
  let phone = event.target.value.replace(/\D/g, ''); 
  if (phone.length > 11) phone = phone.slice(0, 11);
  phone = phone.replace(/^(\d{2})(\d)/, '($1) $2');
  if (phone.length <= 13) phone = phone.replace(/(\d{4})(\d)/, '$1-$2');
  else phone = phone.replace(/(\d{5})(\d)/, '$1-$2');
  form.telefone = phone;
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; margin: 0; padding: 0; }

.auth-bg {
  min-height: 100vh; background: #0b1120;
  display: flex; align-items: center; justify-content: center;
  position: relative; overflow: hidden; font-family: 'Inter', sans-serif; padding: 40px 0;
}
.glow { position: absolute; width: 500px; height: 500px; border-radius: 50%; filter: blur(120px); pointer-events: none; }
.glow-top { top: -15%; left: -10%; background: rgba(37,99,235,0.2); }
.glow-bottom { bottom: -15%; right: -10%; background: rgba(99,102,241,0.18); }

.card-wrapper { width: 100%; max-width: 580px; padding: 0 20px; position: relative; z-index: 10; }
.card {
  background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
  border-radius: 28px; padding: 44px 40px;
  backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(30px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.icon-box {
  width: 62px; height: 62px; background: linear-gradient(135deg, #2563eb, #60a5fa);
  border-radius: 20px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 24px auto; box-shadow: 0 8px 28px rgba(37,99,235,0.4);
}
.icon-box svg { width: 30px; height: 30px; color: #fff; }

.card-title { font-size: 24px; font-weight: 900; color: #fff; text-align: center; margin-bottom: 6px; }
.card-subtitle { font-size: 13px; color: #94a3b8; text-align: center; margin-bottom: 32px; font-weight: 500; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px; }
@media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }

.field { display: flex; flex-direction: column; gap: 8px; }
.field label { display: block; font-size: 10px; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.12em; }

.input-wrapper input, .input-wrapper select {
  width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07);
  border-radius: 12px; padding: 14px 16px; color: #fff; font-size: 14px;
  font-family: 'Inter', sans-serif; outline: none; transition: all 0.25s;
}
.input-wrapper input::placeholder { color: #475569; }
.input-wrapper input:focus, .input-wrapper select:focus {
  border-color: rgba(96,165,250,0.5); background: rgba(255,255,255,0.08);
  box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}

.form-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 32px; gap: 12px; }

.btn-back { font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; transition: color 0.2s; }
.btn-back:hover { color: #e2e8f0; }

.btn-primary {
  padding: 13px 28px; background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 12px; color: #fff; font-size: 14px; font-weight: 800;
  font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.3s;
  box-shadow: 0 6px 20px rgba(37,99,235,0.35);
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-2px); }

/* Custom select icon */
select {
  appearance: none;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
  background-position: right 14px center;
  background-repeat: no-repeat;
  padding-right: 40px !important;
}
</style>
