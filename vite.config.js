import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    theme: {
        extend: {
            backgroundColor: {
                'custom-blue': '#007ACC', // Define tu propio color personalizado
            },
        },
    },
    variants: {},

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
