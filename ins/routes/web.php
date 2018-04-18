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

Route::get('/','IndexController@home');
Route::get('/Content/{type}','IndexController@Content');
Route::get('/articleList/{type}','IndexController@articleList');
Route::get('/GZDT','IndexController@GZDT');

Route::get('/getImg/{id}','FileController@getImg');
Route::post('/uploadImg','FileController@uploadImg');
Route::post('/addFace','FileController@addFace');

Route::any('/login',"BackController@login");
Route::any('/logout',"BackController@logout");
Route::get('/changePwd/{newPwd}',"BackController@changePwd");

Route::group(["prefix" => "manage","middleware" => "loginCheck"],function(){
	Route::get("/","BackController@main");
	Route::get("/teamRefresh","BackController@refresh");
	Route::any("/createField","BackController@createField");
	Route::post("/createMember","BackController@createMember");
	Route::any("/delField/{field_key}","BackController@delField");
	Route::any("/delMember/{memberKey}","BackController@delMember");
	Route::get("/delArticle/{id}","BackController@delArticle");
});

Route::post('/articleUp','ArticleController@articleUp');
Route::get('/article/{id}','ArticleController@articleGet');
Route::get('/member/{id}','ArticleController@memberGet');
Route::get('/field/{fie_key}','ArticleController@fieldGet');