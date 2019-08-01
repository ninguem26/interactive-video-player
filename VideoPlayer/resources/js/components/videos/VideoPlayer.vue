<template>
    <div>
        <div id="canvas" class="video-box">
            <div class="video-content-layer">
                <div class="container-fluid">
                    <div class="row">
                        <video-content
                            v-for="content in contents"
                            v-bind="content"
                            :key="content.id"
                        ></video-content>
                    </div>
                </div>
            </div>
            <div>
                <video id="my-video" class="plyr">
                    <source v-if="url" :src="'/' + url" :type="'video/' + format">
                    Não foi possível carregar o vídeo
                </video>
            </div>
        </div>
        <div v-if="marks.length > 0" class="card">
            <div class="card-body">
                <h5 class="card-title">Marcações</h5>
            </div>
            <div class="list-group list-group-flush">
                <button type="button" v-for="mark in marks" @click="jumpTo(parseInt(JSON.parse(mark.options).start_at))" class="list-group-item list-group-item-action">
                    <h6>
                        {{ mark.data.title }}
                        <small class="card-subtitle mb-2 text-muted">
                            {{ timeString(JSON.parse(mark.options).start_at) }}
                        </small>
                    </h6>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    //import Plyr from "plyr";
    import Vue from 'vue';
    import * as videoCollector from "../../video.js";

    function Content(content) {
        this.id = content.id;
        this.videoId = content.video_id;
        this.type = content.type;
        this.options = content.options;
        this.data = content.data;
    }

    export default {
        props: ['id', 'title', 'url', 'format', 'duration'],
        data() {
            return {
                player: null,
                contents: [],
                marks: [],
                currentTime: 0,
                zIndex: 0,
                actualMark: 0,
                sessionId: 0
            }
        },
        methods: {
            getVideoContent() {
                this.$http.get('/api/video_contents/videos/' + this.id).then(({ data }) => {
                    data['data'].forEach(content => {
                        this.contents.push(new Content(content));
                        if(content.type == "mark") {
                            this.marks.push(new Content(content));
                        }
                    });
                    if(this.marks.length > 0) {
                     this.actualMark = this.marks[0].id;
                    }
                });
            },
            setCurrentTime(time) {
                this.currentTime = time;
            },
            isPlaying() {
                return videoCollector.player.playing;
            },
            isPaused() {
                return videoCollector.player.paused;
            },
            play() {
                if(this.isPaused()) {
                    videoCollector.player.play();
                }
            },
            pause() {
                if(this.isPlaying()) {
                    videoCollector.player.pause();
                }
            },
            jumpTo(time) {
                videoCollector.player.currentTime = time;
                this.setCurrentTime(time);

                var jumpToMark = new CustomEvent('jumptomark', {
                    detail: {
                        video_mark_id: this.markByTime(time)
                    }
                });
                document.dispatchEvent(jumpToMark);
            },
            markByTime(time) {
                var markId = 0;
                var markIndex = 0;

                for(var i = 0; i < this.marks.length; i++) {
                    var startAt = parseInt(JSON.parse(this.marks[i].options).start_at);
                    if(markId == 0) {
                        if(startAt <= time) {
                            markId = this.marks[i].id;
                            markIndex = i;
                        }
                    } else {
                        if(startAt <= time && startAt > parseInt(JSON.parse(this.marks[markIndex].options).start_at)) {
                            markId = this.marks[i].id;
                        }
                    }
                }

                return markId;
            },
            timeString(time) {
                var t = "";

                var hours = time/3600;
                var minutes = (hours - parseInt(hours)) * 60;
                var seconds = (minutes - parseInt(minutes)) * 60;
                return parseInt(minutes) + ":" + parseInt(seconds);
            }
        },
        created() {
            this.getVideoContent();
        },
        mounted() {
            var self = this;

            this.$http.get('/api/session').then(({ data }) => {
                this.sessionId = data['session_id'];

                videoCollector.init("#my-video", this.id, this.sessionId);
                videoCollector.player.on('timeupdate', function() {
                    self.currentTime = videoCollector.player.currentTime;
                });
            });
        },
    }
</script>
