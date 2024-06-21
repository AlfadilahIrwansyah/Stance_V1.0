import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/itemAdd.css',
                'resources/css/pagination.css',
                'resources/css/sales.css',
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
        port: 8080,
        hmr: {
            host: 'localhost',
        },
    }
});
