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


Route::get('/', 'NewsController@show')->name('news.show');

Route::get('/dashboard', 'HomeController@dashboard')->middleware('auth');
Route::get('/article/{article}', 'HomeController@show')->name('single.page');
Route::get('/categories/article/{article}', 'HomeController@showcateg')->name('categories.article');


Route::resource('news', 'NewsController')->middleware('auth');
Route::resource('categories', 'CategoriesController')->middleware('auth');;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/trash/', 'NewsController@trash')->name('news.trash')->middleware('auth');
Route::put('/restore/news/{new}', 'NewsController@restore')->name('news.restore')->middleware('auth');;
Route::put('/restore/categories/{categories}', 'CategoriesController@restore')->name('categories.restore')->middleware('auth');;
Auth::routes();

