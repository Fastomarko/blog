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
Route::post('article/insert_article', 'BlogController@insert_article');//само добавление
Route::post('article/{article}/update_article', 'BlogController@update_article');
Route::get('/', 'BlogController@index');
Route::get('/article/insert', 'BlogController@article_insert_page');//переводит на форму добавления
Route::get('/article/{article}/update', 'BlogController@article_update_page');//переводит на форму изменения
Route::get('/article/{article}/delete', 'BlogController@delete_article');//удаляет статью


Route::get('article/{article}', 'BlogController@article');

Auth::routes();

Route::get('/home', 'BlogController@index');
