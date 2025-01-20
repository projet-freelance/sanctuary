import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],  // Changez app.js en app.jsx ici
            refresh: true,
        }),
        react(),  // Plugin React pour gérer le JSX
    ],
});
