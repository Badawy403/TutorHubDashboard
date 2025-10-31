import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'
export default defineConfig({
    build: {
        chunkSizeWarningLimit: 100000000
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
               refresh: [
                'resources/js/**',
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
            ],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
        resolve: {
        alias: [{
            find: '@',
            replacement:'/resources/js'
        },

        {
            find: '~bootstrap',
            replacement : path.resolve(__dirname, 'node_modules/bootstrap'),
        },
        {
            find: '~bootstrap-icons',
            replacement : path.resolve(__dirname, 'node_modules/bootstrap-icons'),
        },
         {
            find: '~select2',
            replacement : path.resolve(__dirname, 'node_modules/select2'),
        },
         {
            find: '~vue3-carousel',
            replacement : path.resolve(__dirname, 'node_modules/vue3-carousel'),
        },
    ],
    },
    ssr: {
        noExternal: ['@inertiajs/server'],
    },
});
