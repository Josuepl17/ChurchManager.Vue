import { createApp, h } from 'vue';
import { Link } from '@inertiajs/vue3'; // importei o componenete 
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Layout from './Components/Layout.vue';
import { useForm } from '@inertiajs/vue3';
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';



createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('layout', Layout)
            .component('useForm', useForm)
            .component('Link', Link ) // registrei o componente Link do imnertia 
            .mount(el);
    },
    progress: {
        color: 'red',
    },
});
