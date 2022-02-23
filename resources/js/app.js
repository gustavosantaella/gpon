require('./bootstrap');

// Import modules...
import  { createApp, h }  from 'vue';

import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

//sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
//toast notification
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

// Helpers
import {hasRolesOrPermissions, permission} from '@/Helpers/RoleAndPermissions'
import { access, action, $destroyNotify, $download } from "@/Helpers/Functions";






const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const appvue = createInertiaApp({

    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(LaravelPermissionToVueJS)
            .use(VueToast)
            .use(VueSweetalert2)
            .mixin({
                methods: {
                    route,
                    hasRolesOrPermissions,
                    access,
                    action,
                    $destroyNotify,
                    $download
                },
            });

	    appVue.mount(el)
            return appVue;
    },
});





InertiaProgress.init({ color: 'red' });
