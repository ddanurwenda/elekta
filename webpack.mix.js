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

mix.scripts([
    'node_modules/flot/jquery.flot.js',
    'node_modules/flot/jquery.flot.time.js',
    'node_modules/flot/jquery.flot.categories.js'
], 
'public/vendor/flot/flot.bundle.js')
        .scripts(['node_modules/moment/min/moment.min.js'],
'public/vendor/moment/moment.min.js')
        .scripts([
    'node_modules/amcharts3/amcharts/amcharts.js',
    'node_modules/amcharts3/amcharts/serial.js',
    'node_modules/amcharts3/amcharts/themes/light.js',
],
'public/vendor/amcharts/amcharts.bundle.js')
        .scripts(['node_modules/sigma/build/sigma.min.js'],'public/vendor/sigma/sigma.min.js');
