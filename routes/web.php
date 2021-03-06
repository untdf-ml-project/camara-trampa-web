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

Auth::routes();

Route::get('/', function () { return view('about'); })->name('about');;

Route::get('pictures/classify/{validated?}', 'PictureController@classify')->name('classify');
Route::resource('pictures', 'PictureController');
