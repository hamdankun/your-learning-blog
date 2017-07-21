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

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// });


Route::group(['namespace' => 'Admin', 'as' => 'admin.' ,'prefix' => 'admin'], function($router) {

    $router->group(['middleware' => 'auth'], function($router) {
        $router->get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        $router->resource('article', 'ArticleController');
        $router->resource('category', 'CategoryController');
        $router->group(['prefix' => 'datatable'], function($router) {
            $router->get('category', 'CategoryController@getData')->name('datatable.category');
            $router->get('article', 'ArticleController@getData')->name('datatable.article');
        });
    });

    $router->group(['middleware' => 'guest'], function($router) {
        $router->get('login', ['as' => 'login.index', 'uses' => 'AuthController@index']);
        $router->post('login', ['as' => 'login.attemp', 'uses' => 'AuthController@attempt']);
        $router->post('logout', ['as' => 'login.logout', 'uses' => 'AuthController@logout']);
    });
});