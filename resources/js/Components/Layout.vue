
<template lang="">
    <div>
        <div id="conteiner-geral">

<nav id="cabecalho">
    <h4>IPDR - MANGUE</h4>
    <div id="usuario">
        <p>Bem Vindo Josué Lima</p> &nbsp; &nbsp;
        <img src="\static\logo.png" alt="alt">
    </div>
</nav> <!--cabecalho-->


<div id="menu-subtable">

    <div id="menu">

        <div id="open-menu">&#9776;</div>
        <h1>
            <i class="fa-solid fa-compass"></i>
            &nbsp; Menu
        </h1>

        <Link class="links-1" href="/">
            <i><img src="/static/botao-home.png" alt=""></i> &nbsp; <p>Home</p>
        </Link>

        <Link class="links-2" href="/oferta">
            <i><img src="/static/dinheiro.png" alt=""></i> &nbsp; <p>Ofertas</p>
        </Link>

        <Link class="links-3" href="/despesas">
            <i><img src="/static/despesas.png" alt=""></i> &nbsp; <p>Despesas</p>
        </Link>

        <Link class="links-8" href="/eventos">
            <i><img src="/static/comparecimento.png" alt=""></i> &nbsp; <p>Presença</p>
        </Link>

        <Link class="links-4" href="/relatorio">
            <i><img src="/static/pago.png" alt=""></i> &nbsp; <p>Resumo</p>
        </Link>

        <Link class="links-5" href="/indexcaixa">
            <i><img src="/static/contrato.png" alt=""></i> &nbsp; <p>Caixa</p>
        </Link>

        <Link class="links-6" href="/user/profile">
            <i><img src="/static/sombra-de-usuario-masculino.png" alt=""></i> &nbsp; <p>Usuários</p>
        </Link>

        <Link class="links-7" href="/selecionar/filial">
            <i><img src="/static/companhia.png" alt=""></i> &nbsp; <p>Selecionar Filial</p>
        </Link>

        <a class="links-9" href="/logout">
            <i><img src="/static/simbolo-de-logout.png" alt=""></i> &nbsp; <p>Logout</p>
        </a>   


    </div> <!--menu-->


    <div id="subtabela-conteudo">



        <div id="subtabela">
            <slot name="subtabela"></slot>
        </div> <!--subtabela-->

        <div id="titulo-pagina">
            <h3>
                <slot name="titulo-pagina"></slot>
            </h3>
        </div> <!--titulo-pagina-->

        <div id="conteudo">
            <slot name="conteudo"></slot>
        </div> <!--conteudo-->





</div> <!--subtabela-conteudo-->
</div> <!--menu-subtable-->
</div> <!--conteiner-geral-->
    </div>
    
</template>


<script>
        // Seleciona todos os links com a classe 'link'
        const links = document.querySelectorAll('.link');

        // Adiciona um evento de clique a cada link
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                // Previne o comportamento padrão do link
                event.preventDefault();

                // Remove a classe 'selected' de todos os links
                links.forEach(link => link.classList.remove('selected'));

                // Adiciona a classe 'selected' ao link clicado
                this.classList.add('selected');
            });
        });
    </script>

<style>
@import "..\Components\css\layout.css";
@import "..\Components\css\oferta-dizimo-despesas-caixa.css";
</style>





