const { mix } = require('laravel-mix');

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
   // .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/custom.css', 'public/css/custom.css')
   .js('resources/assets/js/admin/category.js', 'public/js/category.js')
   .js('resources/assets/js/admin/artickle.js', 'public/js/artickle.js')
   .js('resources/assets/js/main.js', 'public/js/main.js')
   .js('resources/assets/js/utils.js', 'public/js/utils.js')
   .js('resources/assets/js/datatable-builder.js', 'public/js/datatable-builder.js');
