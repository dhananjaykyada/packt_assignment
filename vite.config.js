import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

const ASSET_URL = process.env.ASSET_URL || '';

export default defineConfig({
    base: `${ASSET_URL}`,
    server: {
        host: 'localhost',
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
