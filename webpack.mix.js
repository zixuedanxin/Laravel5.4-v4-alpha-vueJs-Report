let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .scripts([
        'public/js/dataTables.bootstrap4.min.js',
    ], 'public/js/all.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
    'public/css/custom.css',
    'public/css/dataTables.bootstrap4.min.css',
    'public/css/buttons.bootstrap4.min.css',
], 'public/css/all.css');
