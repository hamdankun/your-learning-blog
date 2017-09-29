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
mix.setPublicPath('dist/');
mix.js('resources/assets/js/app.js', 'dist/js')
   .styles('resources/assets/css/custom.css', 'dist/css/custom.css')
   .js('resources/assets/js/admin/category.js', 'dist/js/category.js')
   .js('resources/assets/js/admin/artickle.js', 'dist/js/artickle.js')
   .js('resources/assets/js/admin/seo-static.js', 'dist/js/seo-static.js')
   .js('resources/assets/js/main.js', 'dist/js/main.js')
   .js('resources/assets/js/utils.js', 'dist/js/utils.js')
   .js('resources/assets/js/datatable-builder.js', 'dist/js/datatable-builder.js')
   .js('resources/assets/js/frontend/main-frontend.js', 'dist/js/main-frontend.js')
   .js('resources/assets/js/frontend/home.js', 'dist/js/home-frontend.js')
   .js('resources/assets/js/frontend/article.js', 'dist/js/article-frontend.js')
   .js('resources/assets/js/frontend/article-factory.js', 'dist/js/article-factory.js')
   .js('resources/assets/js/frontend/article-detail.js', 'dist/js/article-detail.js');
