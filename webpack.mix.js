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


//Compiled styles for app
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

//Compiled js files for app
mix.scripts([
    'public/js/app/jquery/jquery-2.2.4.min.js',
    'public/js/app/bootstrap.min.js',
    'public/js/app/wow.min.js',
    'public/js/app/active.js',
    'public/js/app/plugins.js',
    'public/js/app/popper.min.js',
    'public/js/app/web-animations.min.js'
], 'public/js/app-js.js');

//Compiled styles for admin page
mix.styles([
    'public/css/admin/bootstrap.min.css',
    'public/css/admin/font-awesome.min.css',
    'public/css/admin/ionicons.min.css',
    'public/css/admin/jquery-jvectormap.css',
    'public/css/admin/AdminLTE.min.css',
    'public/css/admin/_all-skins.min.css',
    'public/css/admin/_all.css',
    'public/css/app/select2.min.css'
], 'public/css/admin-styles.css');

//Compiled js files for admin page
mix.scripts([
    'public/js/admin/jquery.min.js',
    'public/js/admin/bootstrap.min.js',
    'public/js/admin/fastclick.js',
    'public/js/admin/adminlte.min.js',
    'public/js/admin/jquery.sparkline.min.js',
    'public/js/admin/jquery-jvectormap-1.2.2.min.js',
    'public/js/admin/jquery-jvectormap-world-mill-en.js',
    'public/js/admin/jquery.slimscroll.min.js',
    'public/js/admin/Chart.js',
    'public/js/admin/icheck.min.js',
    'public/js/admin/inputmask.date.extensions.js',
    'public/js/admin/inputmask.extensions.js',
    'public/js/admin/inputmask.js',
    'public/js/admin/inputmask.numeric.extensions.js',
    'public/js/admin/inputmask.phone.extensions.js',
    'public/js/admin/jquery.inputmask.js',
    'public/js/admin/select2.full.min.js'

    /*
    'public/js/admin/abstract-element.js',
    'public/js/admin/abstract-canvas-element.js',
    'public/js/admin/abstract-shape-element.js',
    'public/js/admin/color-scale.js',
    'public/js/admin/data-series.js',
    'public/js/admin/jquery-mousewheel.js',
    'public/js/admin/jvectormap.js',
    'public/js/admin/legend.js',
    'public/js/admin/map-object.js',
    'public/js/admin/map.js',
    'public/js/admin/marker.js',
    'public/js/admin/multimap.js',
    'public/js/admin/numeric-scale.js',
    'public/js/admin/ordinal-scale.js',
    'public/js/admin/proj.js',
    'public/js/admin/region.js',
    'public/js/admin/simple-scale.js',
    'public/js/admin/svg-canvas-element.js',
    'public/js/admin/svg-circle-element.js',
    'public/js/admin/svg-element.js',
    'public/js/admin/svg-group-element.js',
    'public/js/admin/svg-image-element.js',
    'public/js/admin/svg-path-element.js',
    'public/js/admin/svg-shape-element.js',
    'public/js/admin/svg-text-element.js',
    'public/js/admin/vector-canvas.js',
    'public/js/admin/vml-canvas-element.js',
    'public/js/admin/vml-circle-element.js',
    'public/js/admin/vml-element.js',
    'public/js/admin/vml-group-element.js',
    'public/js/admin/vml-image-element.js',
    'public/js/admin/vml-path-element.js',
    'public/js/admin/vml-shape-element.js',
    */
], 'public/js/admin-js.js');