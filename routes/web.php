<?php

Route::get('/test',"TestController@index");

//注册
Route::get('/registor',"RegistorController@index");
Route::post('/registor',"RegistorController@registor");

//登录
Route::get('/login',"LoginController@index");
Route::post('/login',"LoginController@login");
Route::get('/logout',"LoginController@logout");
//个人页面
Route::get('/user',"UserController@index");
Route::get('/user/setting',"UserController@setting");
Route::post('/user/setting',"UserController@settingUser");

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
