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

//mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'public/css/app/animate.css',
    'public/css/app/bootstrap.min.css',
    'public/css/app/core-style.css',
    'public/css/app/font-awesome.min.css',
    'public/css/app/jquery-ui.min.css',
    'public/css/app/magnific-popup.css',
    'public/css/app/nouislider.css',
    'public/css/app/owl.carousel.css',
    'public/css/app/responsive.css',
    'public/css/app/style.css',
    'public/css/app/themify-icons.css'
], 'public/css/app-styles.css');

mix.scripts([
    'public/js/app/jquery/jquery-2.2.4.min.js',
    'public/js/app/bootstrap.min.js',
    'public/js/app/wow.min.js',
    'public/js/app/active.js',
    'public/js/app/plugins.js',
    'public/js/app/popper.min.js',
    'public/js/app/web-animations.min.js',
], 'public/js/app-js.js');