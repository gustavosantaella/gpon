require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import axios from 'axios';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const appvue = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVUe = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(LaravelPermissionToVueJS)
            .mixin({ methods: { route } })
            .mount(el);

            
            return appVUe;
    },
});





InertiaProgress.init({ color: '#4B5563' });
