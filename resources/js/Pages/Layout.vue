
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

        <inertia-link class="links-1" :href="route('index')">
            <i><img src="public\botao-home.png" alt=""></i> &nbsp; <p>Home</p>
        </inertia-link>

        <inertia-link class="links-2" >
            <i><img src="public\dinheiro.png" alt=""></i> &nbsp; <p>Ofertas</p>
        </inertia-link>

        <inertia-link class="links-3" >
            <i><img src="public\despesas.png" alt=""></i> &nbsp; <p>Despesas</p>
        </inertia-link>

        <inertia-link class="links-8" >
            <i><img src="public\comparecimento.png" alt=""></i> &nbsp; <p>Presença</p>
        </inertia-link>

        <inertia-link class="links-4" >
            <i><img src="public\pago.png" alt=""></i> &nbsp; <p>Resumo</p>
        </inertia-link>

        <inertia-link class="links-5" >
            <i><img src="public\contrato.png" alt=""></i> &nbsp; <p>Caixa</p>
        </inertia-link>

        <inertia-link class="links-6" >
            <i><img src="public\sombra-de-usuario-masculino.png" alt=""></i> &nbsp; <p>Usuários</p>
        </inertia-link>

        <inertia-link class="links-7" >
            <i><img src="public\companhia.png" alt=""></i> &nbsp; <p>Selecionar Filial</p>
        </inertia-link>

        <inertia-link class="links-9" >
            <i><img src="public\simbolo-de-logout.png" alt=""></i> &nbsp; <p>Logout</p>
        </inertia-link>   


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
<script>
  import { Link } from '@inertiajs/vue3';
export default {
  
}
</script>

<style lang="">

</style>

