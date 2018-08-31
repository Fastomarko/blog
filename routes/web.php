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
Route::post('article/{article}/insert_comment', 'BlogController@insert_comment')->middleware('auth');
Route::post('article/{article}/insert_like', 'BlogController@insert_like')->middleware('auth');
Route::resource('article', 'ArticleController');//middleware нужен, но не для всех

Auth::routes();
Route::get('/', 'BlogController@index');
//убери один из них
Route::get('/home', 'BlogController@index');
Route::get('/about_us', 'BlogController@about_us');
Route::get('/terms_of_use', 'BlogController@terms_of_use');
Route::get('/categories/{category}', 'BlogController@categories');//сотрировка по категориям в nav-баре
