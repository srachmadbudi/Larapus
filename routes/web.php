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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('nama-url', ['middleware'=>'guest', 'uses'=>'MyController@myMethod']);

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
    // Route diisi disini...
    Route::resource('authors', 'AuthorsController');
});

use DataTables;

Route::get('user-data', function() {
	$model = App\User::query();

	return DataTables::eloquent($model)->addColumns(['foo','bar','buzz'=>"red"])->toJson();
});