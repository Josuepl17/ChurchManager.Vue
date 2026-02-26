<template>
  <Teleport to="body">
    <Transition name="modal">
      <div
        v-if="modelValue"
        class="modal-overlay"
        @click.self="onBackdrop"
        role="dialog"
        aria-modal="true"
      >
        <div class="modal-container" :class="sizeClass">

          <!-- Header -->
          <div class="modal-header">
            <slot name="header">
              <h2 class="modal-titulo">{{ titulo }}</h2>
            </slot>
            <button class="modal-close" aria-label="Fechar" @click="fecharModal">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Body -->
          <div class="modal-body">
            <slot />
          </div>

          <!-- Footer -->
          <slot name="footer" />

        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  titulo:     { type: String,  default: '' },
  tamanho:    { type: String,  default: 'md' },
  fecharAoClicarFora: { type: Boolean, default: true },
});

const emit = defineEmits(['update:modelValue', 'close']);

const sizeClass = computed(() => {
  if (props.tamanho === 'xs') return 'modal-xs';
  if (props.tamanho === 'sm') return 'modal-sm';
  if (props.tamanho === 'lg') return 'modal-lg';
  if (props.tamanho === 'xl') return 'modal-xl';
  return 'modal-md';
});

function fecharModal() {
  emit('update:modelValue', false);
  emit('close');
}

function onBackdrop() {
  if (props.fecharAoClicarFora) fecharModal();
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

/* Overlay */
.modal-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  font-family: 'Inter', sans-serif;
}

/* Container */
.modal-container {
  width: 100%;
  background: var(--fundo-mais-superior, #111827);
  border: 1px solid var(--borda-padrao, rgba(255, 255, 255, 0.1));
  border-radius: 24px;
  box-shadow: 0 40px 100px rgba(0, 0, 0, 0.8);
  display: flex;
  flex-direction: column;
  max-height: 90vh;
  overflow: hidden;
}

/* Tamanhos */
.modal-xs { max-width: 340px; }
.modal-sm { max-width: 480px; }
.modal-md { max-width: 600px; }
.modal-lg { max-width: 760px; }
.modal-xl { max-width: 960px; }

/* Header */
.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 20px 24px;
  border-bottom: 1px solid var(--borda-fina, rgba(255, 255, 255, 0.08));
  flex-shrink: 0;
}

.modal-titulo {
  font-size: 15px;
  font-weight: 800;
  color: var(--texto-primario, #e2e8f0);
  margin: 0;
  letter-spacing: -0.2px;
}

.modal-close {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background: var(--fundo-superior, rgba(255, 255, 255, 0.05));
  border: 1px solid var(--borda-padrao, rgba(255, 255, 255, 0.08));
  color: var(--texto-secundario, #64748b);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
  flex-shrink: 0;
}
.modal-close svg { width: 16px; height: 16px; }
.modal-close:hover {
  background: rgba(239, 68, 68, 0.12);
  border-color: rgba(239, 68, 68, 0.3);
  color: #f87171;
}

/* Body */
.modal-body {
  padding: 20px 24px;
  overflow-y: auto;
  flex: 1;
  color: var(--texto-primario);
}
.modal-body::-webkit-scrollbar { width: 4px; }
.modal-body::-webkit-scrollbar-thumb { background: var(--borda-padrao, rgba(255,255,255,0.1)); border-radius: 10px; }

/* Animação */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.18s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
  transition: transform 0.2s ease, opacity 0.18s ease;
}
.modal-enter-from .modal-container {
  transform: translateY(16px);
  opacity: 0;
}
.modal-leave-to .modal-container {
  transform: translateY(8px);
  opacity: 0;
}
</style>
