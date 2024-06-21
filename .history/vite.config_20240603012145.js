import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/ItemAdd.js',
                'resources/js/registerValidate.js',
                'resources/css/app.css',
                'resources/css/itemAdd.css',
                'resources/css/itemAdd.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery'
        }
    }
});
