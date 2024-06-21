import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/itemAdd.css',
                'resources/css/pagination.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery'
        }
    },
    server: {
        host: '0.0.0.0',
        port: 80800,
        hmr: {
            host: 'localhost',
        },
    }
});
