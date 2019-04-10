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
                        <input v-model="selectedAlternative" @click="emitSelection(alternative.id)" class="form-check-input" type="radio" name="alternative" :id="'alternative-' + alternative.id" :value="alternative.id">
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
    <div v-else-if="anotation" class="video-content">
        <div class="card">
            <div class="card-body">
                {{ data.text }}
                <button @click="dismiss" type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
                active: true,
                canShowQuestion: true,
                canSkip: false,
                answered: false,
                correct: false,
                alternatives: [],
                selectedAlternative: 0,
                interacted: false,
                events: {
                    submitAnswer: new CustomEvent('submitanswer'),
                    skipQuestion: new CustomEvent('skipquestion'),
                    showAnotation: new CustomEvent('showanotation'),
                    hideAnotation: new CustomEvent('hideanotation')
                }
            }
        },
        computed: {
            problem: function () {
                var optionData = JSON.parse(this.options);
                this.canShow();
                return this.type == 'problem' && this.$parent.currentTime >= parseInt(optionData.start_at) && this.$parent.currentTime <= parseInt(optionData.start_at) + 0.5 && !this.interacted && this.canShowQuestion;
            },
            anotation: function () {
                var optionData = JSON.parse(this.options);
                this.canShow();
                return this.active && this.type == 'anotation' && (this.$parent.currentTime >= optionData.start_at && this.$parent.currentTime <= parseInt(optionData.start_at) + parseInt(optionData.duration));
            },
            mark: function () {
                return this.$parent.markByTime(this.$parent.currentTime) == this.id;
            }
        },
        watch: {
            problem: function () {
                if (this.$parent.isPlaying()) {
                    this.$parent.pause();
                } else if(this.$parent.isPaused()) {
                    this.$parent.play();
                }
            },
            anotation: function () {
                if(this.anotation) {
                    document.dispatchEvent(this.events.showAnotation);
                } else {
                    document.dispatchEvent(this.events.hideAnotation);
                }
            },
            mark: function () {
                if(this.mark) {
                    this.$parent.actualMark = this.id;
                    console.log(this.id);
                    var enterMark = new CustomEvent('entermark', {
                        detail: {
                            video_mark_id: this.id
                        }
                    });
                    document.dispatchEvent(enterMark);
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
            dataToSend() {
                return {
                    video_problem_id: this.data.id,
                    answer: {
                        selected: this.selectedAlternative
                    },
                    expected_answer: JSON.parse(this.data.answers),
                    is_correct: this.correct
                }
            },
            submitAnswer() {
                var answer = JSON.parse(this.data.answers);
                if(this.selectedAlternative == answer) {
                    this.correct = true;
                } else {
                    this.correct = false;
                }

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                this.$http.post('/api/video_answers', {
                    data: this.dataToSend(),
                    _token: CSRF_TOKEN
                }).then(function (response) {});

                this.answered = true;
                this.canSkip = true;

                document.dispatchEvent(this.events.submitAnswer);
            },
            skipQuestion () {
                if(this.correct) {
                    this.interacted = true;
                }
                this.canShowQuestion = false;

                document.dispatchEvent(this.events.skipQuestion);
            },
            emitSelection(value) {
                var alternativeSelect = new CustomEvent('alternativeselected', {
                    detail: {
                        alternative: value
                    }
                });
                document.dispatchEvent(alternativeSelect);
            },
            dismiss() {
                var dismissAnotation = new CustomEvent('dismissanotation', {
                    detail: {
                        content_id: this.id,
                        anotation_id: this.data.id
                    }
                });

                this.active = false;
                document.dispatchEvent(dismissAnotation);
            }
        },
        created() {
            if(this.type == 'problem') {
                this.alternatives = JSON.parse(this.data.alternatives);

                var options = JSON.parse(this.options);
                this.canSkip = !options.obligatory;
            }
        }
    }
</script>
