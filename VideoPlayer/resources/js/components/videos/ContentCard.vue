<template>
    <div class="col-md-6">
        <div class="card">
            <div v-if="!confirmed">
                <div v-if="content.type == ''" class="card-body">
                    <button @click="setContentType('anotation')"class="btn btn-primary btn-block">Anotação</button>
                    <button @click="setContentType('problem')"class="btn btn-primary btn-block">Problema</button>
                    <button @click="setContentType('mark')"class="btn btn-primary btn-block">Marcação</button>
                </div>
                <div v-else-if="content.type == 'problem'" class="card-body">
                    <div v-if="problem.type == ''">
                        <button @click="setProblemType('multi')"class="btn btn-primary btn-block">Múltipla escolha</button>
                        <button @click="setProblemType('open')"class="btn btn-primary btn-block">Aberto</button>
                    </div>
                    <div v-else-if="problem.type == 'multi'">
                        <h5 class="card-title">Problema</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Múltipla escolha</h6>
                        <label for="question">Questão</label>
                        <input v-model="problem.question" type="text" class="form-control" id="question" placeholder="Digite a questão">
                        <label for="question">Alternativas</label>
                        <input v-for="alternative in problem.alternatives" v-model="alternative.text" type="text" class="form-control" id="alternative" placeholder="Digite a alternativa">
                        <button @click="addAlternative" class="btn btn-outline-primary btn-block">
                            <i class="fa fa-plus"></i> Alternativa
                        </button>
                        <div v-if="problem.alternatives.length > 0">
                            <label for="question">Alternativa correta</label>
                            <input v-model="problem.answer" type="number" value="1" min="1" :max="problem.alternatives.length" class="form-control" id="answer" placeholder="Digite a alternativa">
                        </div>
                        <label for="question">Aparecer em</label>
                        <input v-model="content.startAt" type="number" min="0" class="form-control" id="question" placeholder="Digite a questão">
                        <label for="question">Questão de opinião</label>
                        <input type="checkbox" aria-label="Opinião">
                        <label for="question">Obrigatório</label>
                        <input v-model="problem.obligatory" type="checkbox" aria-label="Obrigatório">
                        <button @click="confirm" class="btn btn-outline-primary btn-block">
                            Confirmar
                        </button>
                    </div>
                </div>
                <div v-else-if="content.type == 'anotation'" class="card-body">
                    <h5 class="card-title">Anotação</h5>
                    <label for="text">Texto</label>
                    <input v-model="anotation.text" type="textbox" class="form-control" id="text" placeholder="Anotação...">
                    <label for="start_at">Aparecer em</label>
                    <input v-model="content.startAt" type="number" min="0" class="form-control" id="start_at" placeholder="Digite o tempo inicial">
                    <label for="duration">Duração</label>
                    <input v-model="content.duration" type="number" min="0" class="form-control" id="duration" placeholder="Digite o tempo de duração">
                    <label for="question">Interromper reprodução</label>
                    <input v-model="anotation.obligatory" type="checkbox" aria-label="Interromper reprodução">
                    <button @click="confirm" class="btn btn-outline-primary btn-block">
                        Confirmar
                    </button>
                </div>
                <div v-else-if="content.type == 'mark'" class="card-body">
                    <h5 class="card-title">Marcação</h5>
                    <label for="title">Título</label>
                    <input v-model="mark.title" type="text" class="form-control" id="title" placeholder="Marcação...">
                    <label for="start_at">A partir de</label>
                    <input v-model="content.startAt" type="number" min="0" class="form-control" id="start_at" placeholder="Digite o tempo">
                    <button @click="confirm" class="btn btn-outline-primary btn-block">
                        Confirmar
                    </button>
                </div>
            </div>
            <div v-else>
                <div v-if="content.type == 'problem'">
                    <div class="card-body">
                        <h5 class="card-title">Problema</h5>
                        <h6 v-if="problem.type == 'multi'" class="card-subtitle mb-2 text-muted">Múltipla escolha</h6>
                        <h6 v-else-if="problem.type == 'open'" class="card-subtitle mb-2 text-muted">Aberto</h6>
                        <p class="card-text">{{ problem.question }}</p>
                    </div>
                    <ul class="list-group">
                        <li
                            v-for="alternative in problem.alternatives"
                            class="list-group-item">
                            <div v-if="alternative.id == problem.answer">
                                <b>{{ alternative.text }}</b>
                            </div>
                            <div v-else>
                                {{ alternative.text }}
                            </div>
                        </li>
                    </ul>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Apearece em</h6>
                        <p class="card-text">{{ problem.startAt }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Obrigatório</h6>
                        <p v-if="problem.obligatory" class="card-text">Sim</p>
                        <p v-else class="card-text">Não</p>
                    </div>
                </div>
                <div v-else-if="content.type == 'anotation'">
                    <div class="card-body">
                        <h5 class="card-title">Anotação</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ content.startAt }} - {{ endAt() }}</h6>
                        <p class="card-text">{{ anotation.text }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Interromper reprodução</h6>
                        <p v-if="anotation.obligatory" class="card-text">Sim</p>
                        <p v-else class="card-text">Não</p>
                    </div>
                </div>
                <div v-else-if="content.type == 'mark'">
                    <div class="card-body">
                        <h5 class="card-title">Marcação de Seção</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ content.startAt }}</h6>
                        <p class="card-text">{{ mark.title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    function Alternative(id, text) {
        this.id = id;
        this.text = text;
    }

    export default {
        data() {
            return {
                content: {
                    type: "",
                    startAt: 0,
                    duration: 0
                },
                problem: {
                    type: "",
                    question: "",
                    alternatives: [],
                    answer: null,
                    obligatory: false
                },
                anotation: {
                    text: "",
                    obligatory: false
                },
                mark: {
                    title: ""
                },
                count: 1,
                confirmed: false,
                rightAnswer: 'list-group-item-success'
            }
        },
        methods: {
            setContentType(type) {
                this.content.type = type;
            },
            setProblemType(type) {
                this.problem.type = type;
            },
            addAlternative() {
                this.problem.alternatives.push(new Alternative(this.count++, ""));
            },
            endAt() {
                return parseInt(this.content.startAt) + parseInt(this.content.duration);
            },
            dataToSend() {
                if(this.content.type == 'problem') {
                    return {
                        video_id: this.$parent.id,
                        type: this.content.type,
                        options: {
                            start_at: this.content.startAt,
                            duration: this.content.duration,
                            obligatory: this.problem.obligatory
                        },
                        problem_type: this.problem.type,
                        question: this.problem.question,
                        alternatives: this.problem.alternatives,
                        answers: this.problem.answer
                    }
                } else if(this.content.type == 'anotation') {
                    return {
                        video_id: this.$parent.id,
                        type: this.content.type,
                        options: {
                            start_at: this.content.startAt,
                            duration: this.content.duration,
                            obligatory: this.anotation.obligatory
                        },
                        text: this.anotation.text
                    }
                } else if(this.content.type == 'mark') {
                    return {
                        video_id: this.$parent.id,
                        type: this.content.type,
                        options: {
                            start_at: this.content.startAt,
                        },
                        title: this.mark.title
                    }
                }
            },
            confirm() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if(this.content.type == 'problem') {
                    this.$http.post('/api/video_problems', {
                        data: this.dataToSend(),
                        _token: CSRF_TOKEN
                    }).then(function (response) {});
                } else if(this.content.type == 'anotation') {
                    this.$http.post('/api/anotations', {
                        data: this.dataToSend(),
                        _token: CSRF_TOKEN
                    }).then(function (response) {});
                } else if(this.content.type == 'mark') {
                    this.$http.post('/api/marks', {
                        data: this.dataToSend(),
                        _token: CSRF_TOKEN
                    }).then(function (response) {});
                }

                this.confirmed = true;
            }
        }
    }
</script>
