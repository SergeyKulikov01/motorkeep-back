import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                entryFileNames: (chunkInfo) => {
                    // У Vite CSS-вход (app.css) тоже порождает "пустой" JS-чанк.
                    // Реальным считаем только тот, что собран из resources/js/app.js.
                    if (chunkInfo.facadeModuleId?.endsWith('.css')) {
                        return 'assets/_css-entry.js';
                    }
                    return 'assets/app.js';
                },
                chunkFileNames: 'assets/[name].js',    // разделяемые чанки (если будут) тоже без хеша
                assetFileNames: (assetInfo) => {
                    // CSS-файлы всегда называть app.css
                    if (assetInfo.name?.endsWith('.css')) {
                        return 'assets/app.css';
                    }
                    // Остальные ассеты (шрифты, картинки) – с хешем, чтобы не терялись
                    return 'assets/[name].[hash].[ext]';
                },
            },
        },
    },
});
