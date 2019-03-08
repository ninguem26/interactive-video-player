import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';

Vue.prototype.$http = axios;

Vue.use(VueRouter);

import App from './components/App';
import VideoComponent from './components/videos/VideoComponent';
import VideoList from './components/videos/VideoList';
import VideoPlayer from './components/videos/VideoPlayer';
import VideoPlayerComponent from './components/videos/VideoPlayerComponent';
import VideoEditor from './components/videos/VideoEditor';
import VideoContent from './components/videos/VideoContent';
import ContentCard from './components/videos/ContentCard';

Vue.component('video-component', VideoComponent);
Vue.component('video-player', VideoPlayer);
Vue.component('video-editor', VideoEditor);
Vue.component('video-content', VideoContent);
Vue.component('content-card', ContentCard);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/videos',
            name: 'videos',
            component: VideoList
        },
        {
            path: '/videos/:id',
            name: 'video-page',
            component: VideoPlayerComponent,
            props: true
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
