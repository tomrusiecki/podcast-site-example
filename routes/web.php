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

Route::get('/', 'EpisodesController@episodeList');
Route::get('/feed', 'EpisodesController@feed');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin', 'AdminController@newEpisode')->name('newEpisode');
