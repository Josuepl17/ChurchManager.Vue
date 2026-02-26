<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <div class="card-wrapper">
      <div class="card">
        <div class="icon-box">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>

        <h1 class="card-title">Confirmar Código</h1>
        <p class="card-subtitle">Insira o código de 6 dígitos enviado para o seu e-mail</p>

        <form @submit.prevent="form.post('/confirma/codigo')">
          <div class="field">
            <label>Código de Segurança</label>
            <input type="number" v-model="form.codigo" autocomplete="off" required placeholder="000000" class="input-code" />
            <p v-if="errors?.codigo" class="field-error">{{ errors.codigo }}</p>
          </div>

          <button type="submit" class="btn-primary">Confirmar Código</button>

          <div class="footer-link">
            <Link href="/login">← Voltar para o Login</Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ errors: Object });
const form = useForm({ codigo: '' });
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
* { box-sizing: border-box; margin: 0; padding: 0; }

.auth-bg {
  min-height: 100vh; background: #0b1120;
  display: flex; align-items: center; justify-content: center;
  position: relative; overflow: hidden; font-family: 'Inter', sans-serif;
}
.glow { position: absolute; width: 500px; height: 500px; border-radius: 50%; filter: blur(120px); pointer-events: none; }
.glow-top { top: -15%; left: -10%; background: rgba(37,99,235,0.2); }
.glow-bottom { bottom: -15%; right: -10%; background: rgba(99,102,241,0.18); }

.card-wrapper { width: 100%; max-width: 440px; padding: 0 20px; position: relative; z-index: 10; }
.card {
  background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
  border-radius: 28px; padding: 44px 40px;
  backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(30px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.icon-box {
  width: 62px; height: 62px;
  background: linear-gradient(135deg, #2563eb, #60a5fa);
  border-radius: 20px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 24px auto; box-shadow: 0 8px 28px rgba(37,99,235,0.4);
}
.icon-box svg { width: 30px; height: 30px; color: #fff; }

.card-title { font-size: 24px; font-weight: 900; color: #fff; text-align: center; margin-bottom: 6px; letter-spacing: -0.3px; }
.card-subtitle { font-size: 13px; color: #94a3b8; text-align: center; margin-bottom: 32px; font-weight: 500; }

.field { margin-bottom: 20px; }
.field label { display: block; font-size: 10px; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px; }
.field input, .input-code {
  width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07);
  border-radius: 12px; padding: 14px 18px; color: #fff;
  font-size: 22px; font-family: 'Inter', sans-serif; font-weight: 700; letter-spacing: 0.3em;
  text-align: center; outline: none; transition: all 0.25s;
}
.field input::placeholder, .input-code::placeholder { color: #475569; font-size: 18px; }
.field input:focus, .input-code:focus {
  border-color: rgba(96,165,250,0.5); background: rgba(255,255,255,0.08);
  box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
input[type=number] { -moz-appearance: textfield; }

.field-error { font-size: 12px; color: #f87171; margin-top: 6px; text-align: center; }

.btn-primary {
  width: 100%; padding: 15px; background: linear-gradient(135deg, #2563eb, #4f46e5);
  border: none; border-radius: 13px; color: #fff; font-size: 15px; font-weight: 800;
  font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.3s;
  box-shadow: 0 8px 30px rgba(37,99,235,0.4); margin-bottom: 20px;
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-2px); }
.btn-primary:active { transform: scale(0.98); }

.footer-link { text-align: center; }
.footer-link a { font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; transition: color 0.2s; }
.footer-link a:hover { color: #e2e8f0; }
</style>