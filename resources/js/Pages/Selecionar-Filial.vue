<template>
  <div class="auth-bg">
    <div class="glow glow-top"></div>
    <div class="glow glow-bottom"></div>

    <div class="page-wrapper">
      <div class="page-header">
        <h1>Suas Filiais</h1>
        <p>Selecione uma filial para começar a gerenciar</p>
      </div>

      <div class="cards-grid">
        <div
          v-for="empresa in empresas"
          :key="empresa.id"
          class="company-card"
        >
          <div class="company-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1z" />
            </svg>
          </div>
          <h3 class="company-name">{{ empresa.razao }}</h3>
          <span class="company-id">ID: {{ empresa.id }}</span>
          <a :href="'/entrar/' + empresa.id" class="btn-enter">Acessar Filial</a>
        </div>

        <a href="/cadastrar/empresas" class="company-card new-card">
          <div class="company-icon new-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
          <span class="new-label">Nova Filial</span>
        </a>
      </div>

      <a href="/" class="btn-back">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Menu Principal
      </a>
    </div>
  </div>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({ empresas: Object });
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
  padding: 60px 24px;
}

.glow {
  position: absolute;
  width: 700px;
  height: 700px;
  border-radius: 50%;
  filter: blur(140px);
  pointer-events: none;
}
.glow-top {
  top: -20%;
  left: -10%;
  background: rgba(37, 99, 235, 0.2);
}
.glow-bottom {
  bottom: -20%;
  right: -10%;
  background: rgba(99, 102, 241, 0.18);
}

.page-wrapper {
  width: 100%;
  max-width: 1000px;
  position: relative;
  z-index: 10;
}

.page-header {
  text-align: center;
  margin-bottom: 52px;
}
.page-header h1 {
  font-size: 42px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -1px;
  margin-bottom: 10px;
}
.page-header p {
  font-size: 16px;
  color: #64748b;
  font-weight: 500;
}

.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 18px;
  margin-bottom: 40px;
}

.company-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.07);
  border-radius: 22px;
  padding: 24px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: all 0.4s;
  cursor: pointer;
  text-decoration: none;
}
.company-card:hover {
  border-color: rgba(59, 130, 246, 0.5);
  transform: translateY(-6px);
  box-shadow: 0 20px 60px rgba(37, 99, 235, 0.2);
  background: rgba(59, 130, 246, 0.07);
}

.company-icon {
  width: 52px;
  height: 52px;
  background: rgba(59, 130, 246, 0.1);
  border: 1px solid rgba(59, 130, 246, 0.2);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 14px;
  transition: all 0.4s;
}
.company-card:hover .company-icon {
  background: #3b82f6;
  border-color: #3b82f6;
  transform: scale(1.1);
}
.company-icon svg { width: 24px; height: 24px; color: #60a5fa; transition: color 0.4s; }
.company-card:hover .company-icon svg { color: #fff; }

.company-name {
  font-size: 15px;
  font-weight: 700;
  color: #e2e8f0;
  margin-bottom: 4px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}
.company-id {
  font-size: 10px;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  margin-bottom: 16px;
}

.btn-enter {
  width: 100%;
  padding: 10px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  color: #e2e8f0;
  font-size: 13px;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  text-decoration: none;
  display: block;
  transition: all 0.3s;
}
.company-card:hover .btn-enter {
  background: #2563eb;
  border-color: #2563eb;
  color: #fff;
}

/* Card de nova filial */
.new-card {
  border-style: dashed;
  border-color: rgba(255, 255, 255, 0.12);
  justify-content: center;
  min-height: 160px;
}
.new-card:hover {
  border-color: rgba(59, 130, 246, 0.5);
  background: rgba(59, 130, 246, 0.05);
}

.new-icon {
  background: transparent;
  border: 2px dashed rgba(255, 255, 255, 0.15);
  transition: all 0.4s;
}
.new-card:hover .new-icon {
  background: #3b82f6;
  border-color: #3b82f6;
  transform: scale(1.1);
}
.new-icon svg { color: #475569; }
.new-card:hover .new-icon svg { color: #fff; }

.new-label {
  font-size: 14px;
  font-weight: 700;
  color: #4b5563;
  transition: color 0.3s;
}
.new-card:hover .new-label { color: #e2e8f0; }

/* Botão Voltar */
.btn-back {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin: 0 auto;
  width: fit-content;
  padding: 14px 32px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  color: #64748b;
  font-size: 14px;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
  text-decoration: none;
  transition: all 0.3s;
}
.btn-back svg { width: 16px; height: 16px; transition: transform 0.2s; }
.btn-back:hover {
  color: #e2e8f0;
  background: rgba(255, 255, 255, 0.08);
}
.btn-back:hover svg { transform: translateX(-3px); }
</style>
