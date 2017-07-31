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
mix.setPublicPath('public_html/');
mix.js('resources/assets/js/app.js', 'public_html/js')
   .styles('resources/assets/css/custom.css', 'public_html/css/custom.css')
   .js('resources/assets/js/admin/category.js', 'public_html/js/category.js')
   .js('resources/assets/js/admin/artickle.js', 'public_html/js/artickle.js')
   .js('resources/assets/js/main.js', 'public_html/js/main.js')
   .js('resources/assets/js/utils.js', 'public_html/js/utils.js')
   .js('resources/assets/js/datatable-builder.js', 'public_html/js/datatable-builder.js')
   .js('resources/assets/js/frontend/main-frontend.js', 'public_html/js/main-frontend.js')
   .js('resources/assets/js/frontend/home.js', 'public_html/js/home-frontend.js')
   .js('resources/assets/js/frontend/article.js', 'public_html/js/article-frontend.js')
   .js('resources/assets/js/frontend/article-factory.js', 'public_html/js/article-factory.js');
