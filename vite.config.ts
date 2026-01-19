import { defineConfig } from 'vite';
import { resolve } from 'path';
import dts from 'vite-plugin-dts';

export default defineConfig({
    plugins: [
        dts({
            insertTypesEntry: true,
        }),
    ],
    build: {
        lib: {
            entry: resolve(__dirname, 'resources/js/index.ts'),
            name: 'AcceladeGrids',
            formats: ['es', 'umd'],
            fileName: (format) => `grids.${format === 'es' ? 'esm' : format}.js`,
        },
        outDir: 'dist',
        rollupOptions: {
            output: {
                globals: {},
            },
        },
    },
});
