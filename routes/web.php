<?php

Route::get('/test',"TestController@index");
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
//文章列表 详情
Route::get('/',"PostController@index");
Route::get('/posts',"PostController@index");
Route::get('/posts/detail/{post}',"PostController@show");

//文章新增
Route::get('/posts/create',"PostController@create");
Route::post('/posts',"PostController@store");
//文章编辑
Route::get('/posts/{post}/edit',"PostController@edit");
Route::put('/posts/{post}/update',"PostController@update");
//文章删除
Route::post('/posts/delete/{post}',"PostController@delete");

Route::post('/posts/image/upload',"PostController@upload");
