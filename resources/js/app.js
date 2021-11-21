require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import axios from 'axios';
//sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
//toast notification
import VueToast from 'vue-toast-notification';

import 'vue-toast-notification/dist/theme-sugar.css';



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const appvue = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVUe = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(LaravelPermissionToVueJS)
            .use(VueToast)
            .use(VueSweetalert2)
            .mixin({ methods: { route } })
            .mount(el);


            return appVUe;
    },
});





InertiaProgress.init({ color: '#4B5563' });
