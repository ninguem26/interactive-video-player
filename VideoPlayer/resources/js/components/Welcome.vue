<template>
    <div class="card text-center" style="margin-top: 20px">
        <div class="card-body">
            <h1 class="card-title">Bem vindo!</h1>
            <p class="card-text">Primeiramente, meu nome é <span class="badge badge-secondary">Júlio César</span>
                                 , sou aluno da graduação em Ciência da Computação no Instituto de Computação - UFAL e
                                 agradeço por dedicar um tempo a este rápido experimento.</p>
            <p class="card-text">Ao clicar em <i>continuar</i> você será redirecionado a uma página com um vídeo
                interativo. As instruções do experimento estão embutidas no vídeo.</p>
            <p class="card-text">Divirta-se e, mais uma vez, muito obrigado!</p>
            <router-link :to="{ name: 'video-page', params: { id: 1 } }">
                <button type="button" class="btn btn-primary">Continuar</button>
            </router-link>
        </div>
    </div>
</template>
<script>
    export default {

    }
</script>
