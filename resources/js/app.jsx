import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import '../css/app.css';
import 'react-quill/dist/quill.snow.css'; /* Importez le thème snow (ou un autre thème)  */



import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import RevisionProvider from './Contexts/RevisionProvider';

const appName = import.meta.env.VITE_APP_NAME || 'EasyLearning';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`, import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <RevisionProvider initialCount={props.initialPage.props.revisionCount}>
                <App {...props} />
            </RevisionProvider>
        );
    },
    progress: {
        color: '#cceeff',
    },
});
