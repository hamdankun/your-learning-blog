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

Route::get('/', function () {
    return view('admin.pages.dashboard');
});


Route::group(['namespace' => 'Admin', 'as' => 'admin.' ,'prefix' => 'admin'], function($route) {
    $route->get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    $route->resource('article', 'ArtickleController');
});