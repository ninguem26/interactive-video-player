import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';

Vue.prototype.$http = axios;

Vue.use(VueRouter);

import App from './components/App';
import Welcome from './components/Welcome';
import Feedback from './components/Feedback';
import VideoComponent from './components/videos/VideoComponent';
import VideoList from './components/videos/VideoList';
import VideoPlayer from './components/videos/VideoPlayer';
import VideoPlayerComponent from './components/videos/VideoPlayerComponent';
import VideoEditorComponent from './components/videos/VideoEditorComponent';
import VideoEditor from './components/videos/VideoEditor';
import VideoContent from './components/videos/VideoContent';
import VideoPage from './components/VideoPage';
import ContentCard from './components/videos/ContentCard';
import Dashboard from './components/Dashboard';
import QuestionVisualization from './components/plots/QuestionVisualization';
import InteractionsByTypePlot from './components/plots/InteractionsByTypePlot';
import InteractionsByTimePlot from './components/plots/InteractionsByTimePlot';
import CorrectlyDonePlot from './components/plots/CorrectlyDonePlot';
import AlternativesSelectedPlot from './components/plots/AlternativesSelectedPlot';
import ViewsBySectionPlot from './components/plots/ViewsBySectionPlot';

//Vue.component('welcome', Welcome);
Vue.component('video-page', VideoPage);
Vue.component('video-component', VideoComponent);
Vue.component('video-player', VideoPlayer);
Vue.component('video-player-component', VideoPlayerComponent);
Vue.component('video-editor', VideoEditor);
Vue.component('video-content', VideoContent);
Vue.component('content-card', ContentCard);
Vue.component('question-visualization', QuestionVisualization);
Vue.component('interactions-by-type', InteractionsByTypePlot);
Vue.component('interactions-by-time', InteractionsByTimePlot);
Vue.component('correctly-done', CorrectlyDonePlot);
Vue.component('alternatives-selected', AlternativesSelectedPlot);
Vue.component('views-by-section', ViewsBySectionPlot);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'welcome',
            component: Welcome
        },
        {
            path: '/feedback',
            name: 'feedback',
            component: Feedback
        },
        {
            path: '/videos',
            name: 'videos',
            component: VideoList
        },
        {
            path: '/videos/:id',
            name: 'video-page',
            component: VideoPage,
            props: true
        },
        {
            path: '/videos/:id/editor',
            name: 'video-editor-page',
            component: VideoEditorComponent,
            props: true
        },
        {
            path: '/videos/:id/dashboard',
            name: 'dashboard',
            component: Dashboard,
            props: true
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
