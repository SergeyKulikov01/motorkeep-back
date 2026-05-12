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
                entryFileNames: 'assets/app.js',       // главный JS-файл
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
