const mix = require('laravel-mix');
const path = require('path');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '@module': path.resolve(__dirname, 'resources/js/components/module'),
            '@model': path.resolve(__dirname, 'resources/js/components/model'),
            '@util': path.resolve(__dirname, 'resources/js/components/util'),
            '@service': path.resolve(__dirname, 'resources/js/components/service'),
        },
        extensions: [".js", ".json", ".ts", ".tsx"],
    }
})
