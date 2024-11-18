import { defineConfig, normalizePath } from 'vite';
import laravel from 'laravel-vite-plugin';

import { sync as globSync } from 'glob';

import { resolve } from 'path';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import viteStaticCopyManifest from './viteStaticCopyManifest';

// Get all CSS and JS files dynamically using glob
const scssFiles = globSync('resources/scss/**/*.scss');
const cssFiles = globSync('resources/css/**/*.css');
const jsFiles = globSync('resources/js/**/*.js');

export default defineConfig({
    plugins: [
        viteStaticCopy({
          targets: [
            // {
            //   src: [
            //     normalizePath(resolve(__dirname, 'node_modules/select2/dist/css/select2.min.css')),
            //     normalizePath(resolve(__dirname, 'node_modules/select2/dist/js/select2.min.js'))
            //   ],
            //   dest: 'plugins/select2'
            // },
          ]
        }),
        viteStaticCopyManifest({
          assetsPath: 'public/build/plugins',
          // manifestPath: 'public/build/manifest.json'
        }),
        laravel({
            input: [
              ...scssFiles, // Dynamically include SCSS files
              ...cssFiles, // Dynamically include CSS files
              ...jsFiles,  // Dynamically include JS files

            ],
            refresh: true,
        }),
    ],
});
