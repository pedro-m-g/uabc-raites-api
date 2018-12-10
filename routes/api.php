<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::get('me', 'AuthController@me');
Route::get('refresh', 'AuthController@refresh');

Route::get('posts', 'PostsController@index');
Route::get('posts/feed', 'PostsController@feed');
Route::post('posts', 'PostsController@store');
Route::get('posts/{post}', 'PostsController@show');
Route::post('posts/{post}/trip', 'PostsController@trip');
Route::get('posts/{post}/trip', 'PostsController@passengers');

Route::get('vehicles', 'VehiclesController@index');
Route::post('vehicles', 'VehiclesController@store');
Route::delete('vehicles/{vehicle}', 'VehiclesController@destroy');

Route::get('routes', 'RoutesController@index');
Route::post('routes', 'RoutesController@store');
Route::delete('routes/{route}', 'RoutesController@destroy');