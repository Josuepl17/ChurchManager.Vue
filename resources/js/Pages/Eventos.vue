<template lang="">

<layout>

<!----------------------------------------------------------------------------------->
<template v-slot:subtabela>
        <Link href="/lista/presencas"><button style="padding: 5px;">Inserir</button></Link>
</template> <!--subtabela-->

<!----------------------------------------------------------------------------------->

<template v-slot:titulo-pagina>
Presença
</template> <!--titulo-pagina-->
<!----------------------------------------------------------------------------------->        

<template v-slot:conteudo>
        <div id="tabela-dados">
    <table>
        <tr>
            <th style="width: 4%;">ID</th>
            <th>DATA</th>
            <th>EVENTO</th>
            <th>PRESENTES</th>
            <th>FALTANTES</th>
            
        </tr>
        
        <tr v-for="evento in eventos" :key="evento.id" >
            <td style="background-color: var(--titulos); color:white">{{evento.id}}</td>
            <td>{{evento.datereg}}</td>
            <td>{{evento.evento}}</td>
            <td>{{evento.presentes}}</td>
            <td>{{evento.faltantes}}</td>
            
        </tr>
         
    </table>
</div>    
</template> <!--conteudo-->

<!----------------------------------------------------------------------------------->      
</layout>



</template>
<script setup >
const props = defineProps ({
        eventos:Object,
})

</script>
<style lang="">
        
</style>
