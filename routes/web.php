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
    $router->get('/', ['as' => 'root', 'uses' => 'HomeController@index']);
    $router->group(['prefix' => 'ajax/frontend'], function($router) {
        $router->get('article/{category?}/{slug?}', ['as' => 'ajax.article', 'uses' => 'ArticleController@ajaxRequest']);
        $router->get('search-article', ['as' => 'ajax.article.search', 'uses' => 'ArticleController@ajaxSearch']);
    });
    $router->get('p/category/{slugCategory}', ['as' => 'article.index', 'uses' => 'ArticleController@index']);
    $router->get('p/category/{slugCategory?}/article/{slugArticle?}', ['as' => 'article.show', 'uses' => 'ArticleController@show']);

});


Route::group(['namespace' => 'Admin', 'as' => 'admin.' ,'prefix' => 'admin'], function($router) {

    $router->group(['middleware' => 'auth'], function($router) {
        $router->get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        $router->resource('article', 'ArticleController');
        $router->resource('category', 'CategoryController');
        $router->group(['prefix' => 'datatable'], function($router) {
            $router->get('category', 'CategoryController@getData')->name('datatable.category');
            $router->get('article', 'ArticleController@getData')->name('datatable.article');
        });
        $router->post('logout', ['as' => 'login.logout', 'uses' => 'AuthController@logout']);
    });

    $router->group(['middleware' => 'guest'], function($router) {
        $router->get('login', ['as' => 'login.index', 'uses' => 'AuthController@index']);
        $router->post('login', ['as' => 'login.attemp', 'uses' => 'AuthController@attempt']);
    });
});