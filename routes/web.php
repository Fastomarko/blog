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
Route::post('article/insert_comment', 'BlogController@insert_comment');
Route::post('article/insert_like', 'BlogController@insert_like');
Route::post('article/insert_article', 'BlogController@insert_article');
Route::get('/', 'BlogController@index');
Route::get('/article/insert', 'BlogController@article_insert_page');

Route::get('article/{article}', 'BlogController@article');

Auth::routes();

Route::get('/home', 'BlogController@index');
