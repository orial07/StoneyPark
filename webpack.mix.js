const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/checkout.js', 'public/js')
    .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js')
    .js('node_modules/leaflet/dist/leaflet-src.js', 'public/js')
    .js('node_modules/leaflet-toolbar/dist/leaflet.toolbar-src.js', 'public/js')

    .css('node_modules/leaflet/dist/leaflet.css', 'public/css')
    .css('node_modules/leaflet-toolbar/dist/leaflet.toolbar-src.css', 'public/css')

    .sass('resources/css/app.scss', 'public/css')

    .disableNotifications();