<template lang="">

<div id="conteiner-geral">
            <div class="titulo">
                <h3>{{dados.razao_empresa}} </h3>
            </div>
       
            <nav>
                <Link href="/">Menu Principal</Link>
                <a target="_blank" :href="`/gerar/${dados.dataini}/${dados.datafi}`">Gerar Relatório</a>



<div id="Caixaregistrar">
    <form @submit.prevent="form.post('/fechar')">
        <input type="hidden" name="totaldespesas" v-model="form.totaldespesas" >
        <input type="hidden" name="totalofertas" v-model="form.totalofertas" >
        <input type="hidden" name="saldo" v-model="form.saldo" >

       <button style="background-color: red;" type="submit">Fechar Caixa</button>
    </form>
</div>
            </nav>

            <div id="conteudo">
                <div class="filtro">
                    <form @submit.prevent="form.post('/filtro/pdf')">
                        <input type="date" name="dataini" id="dataini" v-model="form.dataini" required>
                        <input type="date" name="datafi" id="datafi"  v-model="form.datafi" required>
                        <input type="submit" value="Filtrar" require>

                    </form>
                </div>
        
                <div class="conteiner-colunas">
                    <div class="box">
                        <div class="box-1">
                            <p>Membros</p>
                        </div>
                        <div class="box-2">
                            <h1>{{ dados.qtymembros }}</h1>
                        </div>
                        <div class="box-3"></div>
                    </div>
        
                    <div class="box">
                        <div class="box-1">
                            <p style="color: rgb(0, 254, 0);">Dizimos</p>
                        </div>
                        <div class="box-2">
                            <h1>R${{dados.totaldizimos}}</h1>
                        </div>
                        <div class="box-3"></div>
                    </div>
        
                    <div class="box">
        
                        <div class="box-1">
                            <p style="color: rgb(0, 254, 0);">Ofertas</p>
                        </div>
                        <div class="box-2">
                            <h1>R${{dados.totalofertas}}</h1>
                        </div>
                        <div class="box-3"></div>
                    </div>
        
                    <div class="box">
                        <div class="box-1">
                            <p style="color:red;">Despesas</p>
                        </div>
                        <div class="box-2">
                            <h1>R${{dados.totaldespesas}}</h1>
                        </div>
                        <div class="box-3"></div>
                    </div>
        
                    <div class="box">
                        <div class="box-1">
                            <p style="color:blue;">Saldo Atual</p>
                        </div>
                        <div class="box-2">
                            <h1>R${{saldo}}</h1>
                        </div>
                        <div class="box-3"></div>
                    </div>
        
                </div>   
            </div>

        </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  dados: Object,
  saldo: Number,
  dataini: String,
  datafi: String,
});

const form = useForm({

  dataini: '' || props.dataini,
  datafi: '' || props.datafi,

  totalofertas: props.dados.totalofertas,
  totaldespesas: props.dados.totaldespesas,
  saldo: props.saldo,
});



</script>


<style scoped>
* {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
}

:root {
        --titulos: #0A1626;
        --subtitulos: #023859;
        --fundos: #064654;
        --select: #00657c;

}

#conteiner-geral {
        width: 100%;
        height: 97vh;
}

.titulo {

        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 08%;
        background-color: #0A1626;
        color: white;
}

nav {

        display: flex;
        width: 100%;
        height: 5%;
        justify-content: flex-start;
        align-items: center;
        background-color: var(--subtitulos);


}



#conteudo {
        display: flex;
        width: 100%;
        height: 86%;

        flex-direction: column;
        background-color: rgb(192, 192, 192);
}

.box {

        width: 250px;
        height: 55%;
        margin-top: 40px;
}

.box-1 {
        display: flex;
        width: 100%;
        height: 20%;
        font-size: 20px;
        justify-content: center;
        align-items: center;
        background-color: #0d1c31f6;
        color: white;
}

.box-2 {
        display: flex;
        width: 100%;
        height: 65%;
        background-color: white;
        justify-content: center;
        align-items: center;
}

.box-3 {
        display: flex;
        width: 100%;
        height: 15%;
        justify-content: center;
        align-items: center;
        background-color: var(--subtitulos);
}






.filtro {
        padding-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;


}

.conteiner-colunas {

        width: 100%;
        height: 35%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: self-start;
        flex-wrap: wrap;
}

input {
        font-size: 16px;

}

#Caixaregistrar form {
        all: unset;

}

button,
a {
        all: unset;
        cursor: default;
        border: 1px solid rgba(255, 255, 255, 0.503);
        padding: 04px 20px;
        color: white;
        border-radius: 10px;
        font-size: 14px;
        margin-right: 10px;

}

button:hover,
a:hover {
        background-color: #03e9f4;
        color: black;
        transition: 0.6s;
}
</style>
