<template>
    <div>
        <video-player
            v-if="loaded"
            :id="video.id"
            :title="video.title"
            :url="video.url"
            :format="video.format"
            :duration="video.duration"
        ></video-player>
        <video-editor
            v-if="loaded"
            :id="video.id"
            :title="video.title"
            :url="video.url"
            :format="video.format"
            :duration="video.duration"
        ></video-editor>
    </div>
</template>
<script>
    import VideoPlayer from './VideoPlayer.vue';

    function Video(video) {
        this.id = video.id;
        this.title = video.title;
        this.url = video.url;
        this.format = video.format;
        this.duration = video.duration;
    }

    export default {
        data() {
            return {
                video: null,
                loaded: false
            }
        },
        props: ['id'],
        methods: {
            read() {
                this.$http.get('/api/videos/' + this.id).then(({ data }) => {
                    this.video = new Video(data['data']);
                    this.loaded = true;
                });
            }
        },
        created() {
            this.read();
        }
    }
</script>
