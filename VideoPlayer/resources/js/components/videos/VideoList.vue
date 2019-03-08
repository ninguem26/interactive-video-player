<template>
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <video-component
                        v-for="video in videos"
                        v-bind="video"
                        :key="video.id"
                    ></video-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    function Video(video) {
        this.id = video.id;
        this.title = video.title;
        this.durationString = video.durationString;
    }

    import VideoComponent from './VideoComponent.vue';

    export default {
        data() {
            return {
                videos: []
            }
        },
        methods: {
            read() {
                this.$http.get('/api/videos').then(({ data }) => {
                    data['data'].forEach(video => {
                        this.videos.push(new Video(video));
                    });
                });
            }
        },
        created() {
            this.read();
        }
    }
</script>
