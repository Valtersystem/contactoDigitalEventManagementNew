import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: '192.168.1.75', // <-- teu IP local
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.ts',
            ],
            refresh: true,
        }),

        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

        VitePWA({
            registerType: 'autoUpdate',

            devOptions: {
                enabled: true, // <-- ESSENCIAL para funcionar no telemóvel
            },

            includeAssets: ['favicon.ico', 'robots.txt'],

            manifest: {
                name: 'Contacto Digital',
                short_name: 'Contacto',
                description: 'Sistema de gestão Contacto Digital',
                start_url: '/',
                display: 'standalone',
                background_color: '#ffffff',
                theme_color: '#2563eb',

                icons: [
                    {
                        src: '/pwa/icon-192.png',
                        sizes: '192x192',
                        type: 'image/png',
                    },
                    {
                        src: '/pwa/icon-512.png',
                        sizes: '512x512',
                        type: 'image/png',
                    },
                    {
                        src: '/pwa/icon-512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'maskable',
                    },
                ],
            },
        }),
    ],
});
