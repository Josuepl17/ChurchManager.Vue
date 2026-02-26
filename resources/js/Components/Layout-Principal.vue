<template>
    <!-- Layout: Container principal -->
    <div class="layout">
        <div
            v-if="sidebarOpen"
            class="mascara"
            @click="sidebarOpen = false"
        ></div>

        <!-- Menu lateral -->
        <aside
            class="menu-lateral"
            :class="sidebarOpen ? 'menu-aberto' : 'menu-fechado'"
        >
            <div class="conteudo-menu">
                <div class="topo-menu">
                    <!-- Logo Aqui -->
                    <div class="logo-container">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                         </svg>
                        ChurchManager
                    </div>
                </div>

                <!-- Menu lateral: navegação -->
                <nav class="navegacao">
                    <Link
                        href="/"
                        class="item-nav"
                        :class="isActive('/') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1" />
                        </svg>
                        <span>Membros</span>
                    </Link>

                    <Link
                        href="/tela/dizimos"
                        class="item-nav"
                        :class="isActive('/tela/dizimos') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Dízimos</span>
                    </Link>

                    <Link
                        href="/oferta"
                        class="item-nav"
                        :class="isActive('/oferta') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Ofertas</span>
                    </Link>

                    <Link
                        href="/despesas"
                        class="item-nav"
                        :class="isActive('/despesas') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                        <span>Despesas</span>
                    </Link>

                    <Link
                        href="/relatorio"
                        class="item-nav"
                        :class="isActive('/relatorio') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Relatórios</span>
                    </Link>

                    <Link
                        href="/indexcaixa"
                        class="item-nav"
                        :class="isActive('/indexcaixa') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Caixa</span>
                    </Link>

                    <Link
                        href="/eventos"
                        class="item-nav"
                        :class="isActive('/eventos') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Eventos</span>
                    </Link>

                    <Link
                        href="/user/profile"
                        class="item-nav"
                        :class="isActive('/user/profile') ? 'ativo' : ''"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Usuários</span>
                    </Link>
                </nav>

                <!-- Menu lateral: rodapé -->
               <div class="rodape-menu">
                    <div class="perfil-lateral">
                        <svg class="perfil-icone" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M20 21a8 8 0 10-16 0" />
                        </svg>
                        <div class="informacoes">
                            <div class="perfil-nome">Bem-vindo(a)</div>
                            <div class="perfil-legenda">Admin</div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Área principal -->
        <div class="area-principal">
            <!-- Layout: Barra superior -->
            <header class="barra-superior">
                <div class="barra-conteudo">
                    <!-- Barra superior: esquerda (menu + trilha) -->
                    <div class="barra-esquerda">
                        <button class="botao-menu" @click="sidebarOpen = true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M3 12h18M3 18h18" />
                            </svg>
                        </button>
                        <div class="trilha-navegacao">
                            <span class="trilha-pagina">ChurchManager</span>
                            <span class="trilha-separador">/</span>
                            <span class="trilha-atual">{{ caminho }}</span>
                        </div>
                    </div>
                    <!-- Barra superior: direita (pesquisa + perfil) -->
                    <div class="barra-direita">
                        <div ref="perfilRef" class="perfil">
                            <button
                                class="btn-acessar-icon"
                                aria-label="Abrir opções da conta"
                                @click="profileOpen = !profileOpen"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M20 21a8 8 0 10-16 0" />
                                </svg>
                            </button>
                            <div v-if="profileOpen" class="dropdown-perfil">
                                <div class="titulo">Conta</div>
                                <div class="separador"></div>
                                <a @click="AtivarTemaWhite" class="item-dropdown cursor-pointer">
                                    {{ isWhiteMode ? 'Modo Escuro' : 'Modo Claro' }}
                                </a>
                                <Link href="/user/profile" class="item-dropdown">Perfil</Link>
                                <Link href="/logout" class="item-dropdown sair">Sair</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Conteúdo principal -->
            <main class="conteudo">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup lang="js">
import { Link, usePage } from '@inertiajs/vue3';
import { onBeforeUnmount, onMounted, ref } from 'vue';

const { caminho } = defineProps({
    caminho: { type: String, default: 'Visão Geral' },
});
const sidebarOpen = ref(false);
const profileOpen = ref(false);
const perfilRef = ref(null);
const page = usePage();
const isWhiteMode = ref(false);

function isActive(path) {
    if(path === '/') return page.url === '/';
    return page.url.startsWith(path);
}

function onKey(e) {
    if (e.key === 'Escape') {
        sidebarOpen.value = false;
        profileOpen.value = false;
    }
}

function AtivarTemaWhite() {
    isWhiteMode.value = !isWhiteMode.value;
    if (isWhiteMode.value) {
        document.documentElement.classList.add('theme-white');
        localStorage.setItem('theme', 'white');
    } else {
        document.documentElement.classList.remove('theme-white');
        localStorage.setItem('theme', 'dark');
    }
}

function onClickOutside(e) {
    if (
        profileOpen.value &&
        perfilRef.value &&
        !perfilRef.value.contains(e.target)
    ) {
        profileOpen.value = false;
    }
}

onMounted(() => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'white') {
        isWhiteMode.value = true;
        document.documentElement.classList.add('theme-white');
    }

    document.addEventListener('keydown', onKey);
    document.addEventListener('click', onClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('keydown', onKey);
    document.removeEventListener('click', onClickOutside);
});
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>

<style scoped>
.layout {
    background-color: var(--fundo-principal-escuro);
    color: var(--texto-primario);
    min-height: 100dvh;
    max-height: 100dvh;
    display: flex;
    overflow: hidden;
}

:global(.theme-white) .layout {
    background-color: var(--fundo-principal-escuro);
}

.mascara {
    position: fixed;
    inset: 0;
    z-index: 30;
    background-color: var(--modal);
}

.menu-lateral {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 40;
    width: 20rem;
    background-color: var(--fundo-principal-escuro);
    transition: transform 300ms ease;
    backdrop-filter: blur(8px);
    overflow: hidden;
    min-width: 180px;
}

.menu-aberto {
    transform: translateX(0);
}

.menu-fechado {
    transform: translateX(-100%);
}

.conteudo-menu {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.topo-menu {
    height: 3.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0 1rem;
    border-bottom: 1px solid var(--borda-fina);
    background-image: var(--cm-gradient-blue-dark);
    color: white;
}

.logo-container {
    font-weight: bold;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.navegacao {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
}

.item-nav {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    color: var(--texto-primario);
    transition:
        background-color 160ms ease,
        color 160ms ease;
    margin-bottom: 0.25rem;
}

.item-nav svg {
    height: 1.25rem;
    width: 1.25rem;
    transition: color 160ms ease;
}

.item-nav:hover svg {
    color: var(--texto-primario);
}

.item-nav:hover {
    background-color: var(--fundo-superior);
    color: var(--texto-primario);
}

.item-nav.ativo {
    background-color: rgba(59, 130, 246, 0.1);
    color: var(--cm-cor-solida);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-left: 4px solid var(--cm-cor-solida);
    font-weight: 600;
}

.item-nav.ativo svg {
    color: var(--cm-cor-solida);
}

.rodape-menu {
    border-top: 1px solid var(--borda-fina);
    padding: 0.75rem;
}

.perfil-lateral {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border-radius: 0.5rem;
    background-color: var(--fundo-superior);
    padding: 0.75rem;
    border: 1px solid var(--borda-padrao);
}

.perfil-nome {
    font-weight: 500;
    display: inline-block;
}

.perfil-legenda {
    font-size: 0.75rem;
    color: var(--texto-secundario);
}

.perfil-icone {
    height: 1.5rem;
    width: 1.5rem;
    color: var(--texto-primario);
}

.informacoes {
    min-width: 0;
}

.area-principal {
    flex: 1;
    display: flex;
    flex-direction: column;
    margin-left: 0;
}

.barra-superior {
    width: 100%;
    z-index: 10;
    background-image: var(--cm-gradient-blue-dark);
    backdrop-filter: blur(8px);
}

.barra-conteudo {
    height: 3.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 1rem;
    border-bottom: 1px solid var(--borda-header);
    box-shadow: 0 -1px 10px -6px var(--borda-header) inset;
}

.barra-esquerda {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.botao-menu {
    display: grid;
    height: 2.25rem;
    width: 2.25rem;
    place-items: center;
    border-radius: 0.5rem;
    background-color: var(--fundo-superior);
    color: var(--texto-primario);
    transition:
        background-color 160ms ease,
        border-color 160ms ease,
        color 160ms ease,
        transform 120ms ease;
}

.botao-menu svg {
    height: 1.25rem;
    width: 1.25rem;
}

.btn-acessar-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-acessar-icon:hover {
    background: rgba(255, 255, 255, 0.2);
}

.btn-acessar-icon svg {
    width: 20px;
    height: 20px;
}

.trilha-navegacao {
    display: none;
    align-items: center;
    gap: 0.5rem;
    color: white;
}

.trilha-pagina {
    font-weight: 600;
}

.trilha-separador {
    color: var(--texto-terciario);
}

.trilha-atual {
    color: white;
}

.barra-direita {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.perfil {
    position: relative;
}

.dropdown-perfil {
    position: absolute;
    right: 0;
    margin-top: 0.5rem;
    width: 14rem;
    border-radius: 0.75rem;

    background-color: var(--fundo-principal);
    backdrop-filter: blur(8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    animation: surgir 160ms ease-out;
}

.item-dropdown {
    display: block;
    padding: 0.5rem 0.75rem;
    color: var(--texto);
}

.item-dropdown:hover {
    background-color: var(--fundo-superior);
}

.titulo {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    color: var(--texto);
}

.separador {
    margin: 0.25rem 0;
    border-top: 1px solid #27272a;
}

.sair {
    color: #f87171;
}

@keyframes surgir {
    from {
        opacity: 0;
        transform: translateY(-6px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.conteudo {
    flex: 1;
    padding: 0.5rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}

@media (min-width: 900px) {
    .menu-lateral {
        transform: none;
        position: static;
        height: 100vh;
    }

    .mascara {
        display: none;
    }

    .botao-menu {
        display: none;
    }

    .trilha-navegacao {
        display: flex;
    }

    .area-principal {
        margin-left: 0;
        background-color: var(--fundo-principal);
    }
}
</style>
