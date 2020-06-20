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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

/***********************Admin Route************/
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],
	function(){
		Route::get('/file-manager',function(){
			return view('admin.file-manager');
		})->name('file-manager');

		Route::get('/','HomeController@admin')->name('admin');
		Route::resource('banner','BannerController');
		Route::post('banner/detail',"BannerController@getBannerById")->name('banner-detail');

		Route::resource('category','CategoryController');
		Route::post('/category/child' ,'CategoryController@getAllchild')->name('get-child');

		Route::resource('product', 'ProductController');

	});





/***********************seller Route************/
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],
	function(){
		Route::get('/','HomeController@seller')->name('seller');
	});


/***********************user Route************/
Route::group(['prefix'=>'user','middleware'=>['auth','user']],
	function(){
		Route::get('/','HomeController@user')->name('user');
	});