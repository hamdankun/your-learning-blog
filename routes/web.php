<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function($router) {
    $router->group(['middleware' => 'optimize_page'], function($router) {
        $router->get('/', ['as' => 'root', 'uses' => 'YourController@index']);
        $router->get('/site-map', ['as' => 'your.site-map', 'uses' => 'YourController@siteMap']);
        $router->get('/privacy-police', ['as' => 'your.privacy-policy', 'uses' => 'YourController@privacyPolicy']);    
        $router->get('/about-us', ['as' => 'your.about-us', 'uses' => 'YourController@aboutUs']);
        $router->get('/contact-us', ['as' => 'your.contact-us', 'uses' => 'YourController@contactUs']);
        $router->post('/contact-us', ['as' => 'your.contact-us-post', 'uses' => 'YourController@postContactUs']);        
        $router->get('/p/category/{slugCategory}', ['as' => 'article.index', 'uses' => 'ArticleController@index']);
        $router->get('/p/category/{slugCategory?}/article/{slugArticle?}', ['as' => 'article.show', 'uses' => 'ArticleController@show']);
    });
    $router->group(['prefix' => 'ajax/frontend'], function($router) {
        $router->get('/article/{category?}/{slug?}', ['as' => 'ajax.article', 'uses' => 'ArticleController@ajaxRequest']);
        $router->get('/search-article', ['as' => 'ajax.article.search', 'uses' => 'ArticleController@ajaxSearch']);
        $router->get('/popular-article', ['as' => 'ajax.article.popular', 'uses' => 'ArticleController@ajaxPopularArticle']);
    });

});


Route::group(['namespace' => 'Admin', 'as' => 'admin.' ,'prefix' => 'admin'], function($router) {

    $router->group(['middleware' => 'auth'], function($router) {
        $router->get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        $router->resource('/article', 'ArticleController');
        $router->resource('/category', 'CategoryController');
        $router->group(['prefix' => 'datatable'], function($router) {
            $router->get('/category', 'CategoryController@getData')->name('datatable.category');
            $router->get('/article', 'ArticleController@getData')->name('datatable.article');
        });
        $router->post('/logout', ['as' => 'login.logout', 'uses' => 'AuthController@logout']);

        $router->group(['prefix' => 'ajax'], function ($router) {
            $router->post('/upload-image-gallery', ['as' => 'gallery.store', 'uses' => 'GalleryController@store']);
            $router->get('/image-gallery', ['as' => 'gallery.index', 'uses' => 'GalleryController@index']);
        });

        $router->group(['prefix' => 'setting','as' => 'setting.'], function($router) {
            $router->group(['prefix' => 'seo/static', 'as' => 'seo.static.'], function($router) {
                $router->get('', ['as' => 'index', 'uses' => 'SeoStaticContentController@index']);
                $router->post('/save', ['as' => 'store', 'uses' => 'SeoStaticContentController@store']);
            });
            $router->get('/content-static-page', ['as' => 'content-static-page', 'uses' => 'SeoStaticContentController@index']);
        });
    });


    $router->group(['middleware' => 'guest'], function($router) {
        $router->get('/login', ['as' => 'login.index', 'uses' => 'AuthController@index']);
        $router->post('/login', ['as' => 'login.attemp', 'uses' => 'AuthController@attempt']);
    });
});