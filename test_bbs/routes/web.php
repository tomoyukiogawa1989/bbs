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

//最初のページ
Auth::routes();
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home.index');


// ユーザー登録
Route::get('/confirm/get/{token}', 'Controller@getConfirm');
Route::get('/confirm/del/{token}', 'Controller@deleteConfirm');

/****** マイページ ******/
//プロフィール編集
Route::get('/mypage/profile/', 'MypageController@profile')->name('mypage.profile');
Route::post('/mypage/profile/', 'MypageController@profileUpdate')->name('mypage.profileUpdate');

//投稿した記事
Route::get('/bbs/myviews/', 'BbsController@myviews')->name('bbs.myviews');

/****** 掲示板 ******/
Route::get('/bbs/views/', 'BbsController@views')->name('bbs.views');
Route::get('/bbs/one/{id}', 'BbsController@one')->name('bbs.one');
Route::post('/bbs/one/{id}', 'BbsController@comment')->name('bbs.comment.post');

Route::get('/bbs/create/', 'BbsController@create')->name('bbs.create');
Route::post('/bbs/create/', 'BbsController@createPost')->name('bbs.create.post');

Route::get('/bbs/edit/{id}', 'BbsController@edit')->name('bbs.edit');
Route::post('/bbs/edit/{id}', 'BbsController@editUpdate')->name('bbs.editUpdate');

//共通403ページ※最終判定にする必要あり
Route::get('/{url}', 'NotFoundController@index');
