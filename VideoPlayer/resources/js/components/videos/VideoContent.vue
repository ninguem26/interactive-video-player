<template>
    <div v-if="problem" class="col-md-12 video-content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ data.question }}</h5>
            </div>
            <div class="card-body">
                <div v-if="answered">
                    <div v-if="correct" class="alert alert-success" role="alert">
                        Resposta correta!
                    </div>
                    <div v-else class="alert alert-danger" role="alert">
                        Resposta incorreta!
                    </div>
                </div>
                <div v-for="alternative in alternatives" style="overflow: auto">
                    <div class="form-check">
                        <input v-model="selectedAlternative" class="form-check-input" type="radio" name="alternative" :id="'alternative-' + alternative.id" :value="alternative.id">
                        <label class="form-check-label" :for="'alternative-' + alternative.id">
                            {{ alternative.text }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button @click="submitAnswer" class="btn btn-success" :disabled="selectedAlternative == 0">
                    Responder
                </button>
                <button @click="skipQuestion" class="btn btn-warning" :disabled="!canSkip">
                    <i class="fa fa-play"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['id', 'video_id', 'type', 'options', 'data'],
        data() {
            return {
                canShowQuestion: true,
                canSkip: false,
                answered: false,
                correct: false,
                alternatives: [],
                selectedAlternative: 0,
                interacted: false
            }
        },
        computed: {
            problem: function () {
                var optionData = JSON.parse(this.options);
                this.canShow();
                return this.type == 'problem' && this.$parent.currentTime >= optionData.start_at && !this.interacted && this.canShowQuestion;
            },
        },
        watch: {
            problem: function () {
                if (this.$parent.isPlaying()) {
                    this.$parent.pause();
                } else if(this.$parent.isPaused()) {
                    this.$parent.play();
                }
            }
        },
        methods: {
            canShow() {
                var optionData = JSON.parse(this.options);
                if (this.$parent.currentTime < optionData.start_at && !this.interacted) {
                    this.canShowQuestion = true;
                }
            },
            submitAnswer() {
                var answer = JSON.parse(this.data.answers);
                if(this.selectedAlternative == answer) {
                    this.correct = true;
                } else {
                    this.correct = false;
                }
                console.log(this.problem);
                this.answered = true;
                this.canSkip = true;
            },
            skipQuestion () {
                if(this.correct) {
                    this.interacted = true;
                }
                this.canShowQuestion = false;
            }
        },
        created() {
            this.alternatives = JSON.parse(this.data.alternatives);

            var options = JSON.parse(this.options);
            this.canSkip = !options.obligatory;
        }
    }
</script>
