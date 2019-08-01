<template>
    <div class="card text-center" style="margin-top: 20px">
        <div class="card-body">
            <h1 class="card-title">Feedback</h1>
            <div v-if="!submitted">
                <p class="card-text">A sua opinião é importante para o futuro desta ferramenta. Compartilhe comigo seus
                    pensamentos sobre as funcionalidades e possíveis sugestões para melhorias. Críticas são sempre bem vindas!</p>
                <div class="form-group">
                    <textarea v-model="text" class="form-control" rows="3" placeholder="Deixe aqui sua opinião! :)"></textarea>
                </div>
                <button @click="submit" class="btn btn-primary">Enviar</button>
            </div>
            <div v-else>
                <p class="card-text">Obrigado por expôr sua opinião, será de grande ajuda!</p>
                <button @click="newFeedback" class="btn btn-success">Novo feedback</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Feedback",
        data() {
            return {
                text: "",
                submitted: false
            }
        },
        methods: {
            submit() {
                if(this.text != "") {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var self = this;

                    this.$http.post('/api/feedback', {
                        data: {
                            text: this.text
                        },
                        _token: CSRF_TOKEN
                    }).then(function (response) {
                        self.submitted = true;
                    });
                }
            },
            newFeedback() {
                this.submitted = false;
                this.text = "";
            }
        }
    }
</script>

<style scoped>

</style>