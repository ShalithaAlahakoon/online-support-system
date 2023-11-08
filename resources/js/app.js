import './bootstrap';
import '../css/app.css';
import './commonMethods';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import dayjs from "dayjs";
import VueSweetalert2 from "vue-sweetalert2";
import VueSplide from '@splidejs/vue-splide';
import Notifications from 'notiwind';
import print from 'vue3-print-nb';
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import StarRating from 'vue-star-rating'


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({
            render: () => h(App, props)
            })
            .use(plugin)
            .use(dayjs)
            .use(VueSweetalert2)
            .use(Notifications)
            .use(print)
            .use(VueSplide)
            .use(ZiggyVue, Ziggy);
            app.component('VueSelect', VueSelect)
            app.component('StarRating', StarRating)
            app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
