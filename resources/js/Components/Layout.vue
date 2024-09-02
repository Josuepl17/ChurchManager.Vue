
<template lang="">
    <div>
        <div id="conteiner-geral">

<nav id="cabecalho">
    <h4>IPDR - MANGUE</h4>
    <div id="usuario">
        <p>Bem Vindo Josué Lima</p> &nbsp; &nbsp;
        <img src="public\logo.png" alt="alt">
    </div>
</nav> <!--cabecalho-->


<div id="menu-subtable">

    <div id="menu">

        <div id="open-menu">&#9776;</div>
        <h1>
            <i class="fa-solid fa-compass"></i>
            &nbsp; Menu
        </h1>

        <Link class="links-1" href="/cadastro/membro">
            <i><img src="public\botao-home.png" alt=""></i> &nbsp; <p>Home</p>
        </Link>

        <Link class="links-2" href="/teste">
            <i><img src="public\dinheiro.png" alt=""></i> &nbsp; <p>Ofertas</p>
        </Link>

        <Link class="links-3" href="/cadastro/membro">
            <i><img src="public\despesas.png" alt=""></i> &nbsp; <p>Despesas</p>
        </Link>

        <Link class="links-8" href="/cadastro/membro">
            <i><img src="public\comparecimento.png" alt=""></i> &nbsp; <p>Presença</p>
        </Link>

        <Link class="links-4" href="/cadastro/membro">
            <i><img src="public\pago.png" alt=""></i> &nbsp; <p>Resumo</p>
        </Link>

        <Link class="links-5" href="/cadastro/membro">
            <i><img src="public\contrato.png" alt=""></i> &nbsp; <p>Caixa</p>
        </Link>

        <Link class="links-6" href="/cadastro/membro">
            <i><img src="public\sombra-de-usuario-masculino.png" alt=""></i> &nbsp; <p>Usuários</p>
        </Link>

        <Link class="links-7" href="/cadastro/membro">
            <i><img src="public\companhia.png" alt=""></i> &nbsp; <p>Selecionar Filial</p>
        </Link>

        <Link class="links-9" href="/cadastro/membro">
            <i><img src="public\simbolo-de-logout.png" alt=""></i> &nbsp; <p>Logout</p>
        </Link>   


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


        <div id="valor-registrar">
            <p>
                <slot name="valor-registrar"></slot>
            </p>
        </div> <!--valor-registrar-->


    </div> <!--subtabela-conteudo-->
</div> <!--menu-subtable-->
</div> <!--conteiner-geral-->
    </div>
    
</template>
<script setup >
  import { Link } from '@inertiajs/vue3';

</script>





