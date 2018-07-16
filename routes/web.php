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
Route::get('article/insert_comment', 'BlogController@insert_comment');
Route::get('/', 'BlogController@index');

Route::get('article/{article}', 'BlogController@article');


Route::get('/category/1', 'BlogController@category1');
Route::get('/category/2', 'BlogController@category2');
Route::get('/category/3', 'BlogController@category3');
Route::get('/category/4', 'BlogController@category4');

Auth::routes();

Route::get('/home', 'BlogController@index');
