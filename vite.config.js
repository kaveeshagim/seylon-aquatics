import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import autoprefixer from 'autoprefixer'; // Import autoprefixer directly

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Set the desired output directory here
    },
    css: {
        postcss: {
            plugins: [
                autoprefixer(), // Instantiate autoprefixer as a plugin
            ],
        },
    },
});


// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

