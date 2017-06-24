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
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

Route::group(['middleware' => ['web']], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::get('login', [ 'as' => 'login', 'uses' =>'AuthController@login']);
        Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@attempt']);

        Route::get('register', [ 'as' => 'register', 'uses' =>'AuthController@register']);
        Route::post('register', [ 'as' => 'register', 'uses' =>'AuthController@create']);

        Route::get('logout', [ 'as' => 'logout', 'uses' =>'AuthController@logout']);

        Route::get('password.request', ['as' => 'password.request', 'uses' => 'AuthController@passwordRequest']);
    });
    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
        Route::get('/', [ 'as' => '/', 'uses' =>'DashboardController@index']);
    });
    Route::group(['prefix' => 'password'], function() {
         Route::get('request', [ 'as' => 'request', 'uses' =>'AuthController@request']);
    });
});
