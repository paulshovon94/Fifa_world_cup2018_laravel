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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');
Route::get('/services','PagesController@services');
Route::resource('posts','PostsController');
Route::resource('players','PlayersController');
//Route::get('/players/hello/{country}','PlayersController@show_country');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard_player', 'DashboardController@player_index');
Route::get('/dashboard_stadium', 'DashboardController@stadium_index');
