<template>
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
                currentTime: 0,
                zIndex: 0
            }
        },
        methods: {
            getVideoContent() {
                this.$http.get('/api/video_contents/videos/' + this.id).then(({ data }) => {
                    data['data'].forEach(content => {
                        this.contents.push(new Content(content));
                    });
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
            }
        },
        created() {
            this.getVideoContent();
        },
        mounted() {
            var self = this;
            videoCollector.init("#my-video", this.id);
            videoCollector.player.on('timeupdate', function() {
                self.currentTime = videoCollector.player.currentTime;
            });
        },
    }
</script>
