<template>
    <div class="landing-container">
        <!-- Navigation -->
        <nav class="navbar">
            <div class="nav-content">
                <div class="logo">
                    <span class="logo-icon">⛪</span>
                    <span class="logo-text">Church<span>Manager</span></span>
                </div>
                <div class="nav-links">
                    <a href="#features" class="nav-link">Funcionalidades</a>
                    <Link :href="route('login')" class="btn-login">Entrar</Link>
                    <Link :href="route('login')" class="btn-signup">Começar Agora</Link>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="hero">
            <div class="hero-content">
                <h1 class="hero-title animate-up">
                    Gestão Eclesiástica <br />
                    <span>Inteligente e Moderna</span>
                </h1>
                <p class="hero-subtitle animate-up delay-1">
                    Simplifique a administração da sua igreja com nossa plataforma completa. 
                    Membros, finanças e eventos em um só lugar.
                </p>
                <div class="hero-actions animate-up delay-2">
                    <Link :href="route('login')" class="btn-primary">Experimentar Grátis</Link>
                    <a href="#features" class="btn-secondary">Saiba Mais</a>
                </div>
            </div>
            <div class="hero-visual animate-fade">
                <div class="card-mockup">
                    <div class="mockup-header"></div>
                    <div class="mockup-body">
                        <div class="mockup-line"></div>
                        <div class="mockup-line short"></div>
                        <div class="mockup-grid">
                            <div class="mockup-item"></div>
                            <div class="mockup-item"></div>
                        </div>
                    </div>
                </div>
                <div class="blob"></div>
            </div>
        </header>

        <!-- Features Section -->
        <section id="features" class="features">
            <div class="section-header">
                <h2 class="section-title">Tudo o que sua igreja precisa</h2>
                <p class="section-subtitle">Funcionalidades pensadas para facilitar o dia a dia pastoral.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Gestão de Membros</h3>
                    <p>Cadastro completo, acompanhamento de presença e histórico ministerial.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Controle Financeiro</h3>
                    <p>Gestão de dízimos, ofertas e despesas com relatórios automáticos.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Eventos e Datas</h3>
                    <p>Organize calendários, reuniões e eventos especiais com facilidade.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Relatórios Precisos</h3>
                    <p>Visão clara do crescimento da igreja através de dados reais.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="cta-content">
                <h2>Pronto para transformar sua gestão?</h2>
                <p>Junte-se a centenas de igrejas que já modernizaram seus processos.</p>
                <Link :href="route('login')" class="btn-white">Criar Minha Conta</Link>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2026 ChurchManager. Todos os direitos reservados.</p>
                <div class="footer-bottom">
                    Desenvolvido com ❤️ para o Reino.
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

// Helper for route - assuming 'route' helper is available globally via Ziggy
// If not, we'll need to manually handle the paths.
</script>

<style scoped>
/* Reset & Base */
.landing-container {
    --primary: #3b82f6;
    --primary-dark: #1e40af;
    --secondary: #93c5fd;
    --bg-dark: #121214;
    --bg-card: #1b181b;
    --text-white: #e5e7eb;
    --text-gray: #9ca3af;
    
    background-color: var(--bg-dark);
    color: var(--text-white);
    font-family: 'Instrument Sans', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
}

/* Navbar */
.navbar {
    padding: 1.5rem 2rem;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
    background: rgba(18, 18, 20, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.nav-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.5rem;
    font-weight: 800;
}

.logo-text span {
    color: var(--primary);
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-link {
    color: var(--text-gray);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.nav-link:hover {
    color: var(--text-white);
}

.btn-login {
    color: var(--text-white);
    text-decoration: none;
    font-weight: 600;
}

.btn-signup {
    background: var(--primary);
    color: white;
    padding: 0.7rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-signup:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

/* Hero Section */
.hero {
    padding: 10rem 2rem 5rem;
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 4rem;
}

.hero-title {
    font-size: 4rem;
    line-height: 1.1;
    font-weight: 900;
    margin-bottom: 1.5rem;
}

.hero-title span {
    background: linear-gradient(135deg, #3b82f6, #93c5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: var(--text-gray);
    margin-bottom: 2.5rem;
    line-height: 1.6;
    max-width: 500px;
}

.hero-actions {
    display: flex;
    gap: 1.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
    padding: 1rem 2rem;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.5);
}

.btn-secondary {
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-white);
    padding: 1rem 2rem;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: background 0.3s;
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.05);
}

/* Hero Visual */
.hero-visual {
    position: relative;
    display: flex;
    justify-content: center;
}

.card-mockup {
    width: 100%;
    max-width: 450px;
    aspect-ratio: 16/10;
    background: var(--bg-card);
    border-radius: 20px;
    border: 1px solid rgba(59, 130, 246, 0.3);
    padding: 2rem;
    position: relative;
    z-index: 2;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.mockup-header {
    height: 12px;
    width: 60px;
    background: rgba(59, 130, 246, 0.2);
    border-radius: 6px;
    margin-bottom: 2rem;
}

.mockup-line {
    height: 10px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 5px;
    margin-bottom: 1rem;
}

.mockup-line.short {
    width: 60%;
}

.mockup-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 2rem;
}

.mockup-item {
    height: 80px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), transparent);
    border-radius: 12px;
}

.blob {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120%;
    height: 120%;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
    z-index: 1;
}

/* Features */
.features {
    padding: 8rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: var(--text-gray);
    font-size: 1.2rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: var(--bg-card);
    padding: 2.5rem;
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.03);
    transition: all 0.3s;
}

.feature-card:hover {
    transform: translateY(-10px);
    border-color: rgba(59, 130, 246, 0.2);
    background: rgba(255, 255, 255, 0.02);
}

.feature-icon {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.feature-card p {
    color: var(--text-gray);
    line-height: 1.6;
}

/* CTA */
.cta {
    padding: 6rem 2rem;
    max-width: 1000px;
    margin: 4rem auto;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    border-radius: 40px;
    text-align: center;
}

.cta h2 {
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
}

.cta p {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2.5rem;
}

.btn-white {
    background: white;
    color: #1e40af;
    padding: 1.2rem 3rem;
    border-radius: 16px;
    text-decoration: none;
    font-weight: 800;
    transition: transform 0.3s;
    display: inline-block;
}

.btn-white:hover {
    transform: scale(1.05);
}

/* Footer */
.footer {
    padding: 4rem 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    text-align: center;
}

.footer-content p {
    color: var(--text-gray);
}

.footer-bottom {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: var(--text-gray);
}

/* Animations */
.animate-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s forwards;
}

.animate-fade {
    opacity: 0;
    animation: fadeIn 1.2s forwards;
}

.delay-1 { animation-delay: 0.2s; }
.delay-2 { animation-delay: 0.4s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

/* Responsive */
@media (max-width: 900px) {
    .hero {
        grid-template-columns: 1fr;
        text-align: center;
        padding-top: 8rem;
    }

    .hero-title {
        font-size: 2.8rem;
    }

    .hero-subtitle {
        margin-left: auto;
        margin-right: auto;
    }

    .hero-actions {
        justify-content: center;
    }

    .nav-links {
        display: none;
    }
}
</style>
