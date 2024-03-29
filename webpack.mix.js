const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js');
    // .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/css/bootstrap.css',
    'public/css/bootstrap.min.css',
    'public/css/fa5-all.min.css',
    'public/css/jquery.dataTables.min.css',
    'public/css/jquery.toast.css',
    'public/css/loading-tien.css',
    'public/css/neo-style.css',
    'public/css/styles.css'
], 'public/css/all.css');