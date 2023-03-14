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

Route::get('/list', 'TestUsersController@showList')->name('list');

Route::get('/show/create', 'TestUsersController@showCreate')->name('create');

Route::post('/show/store', 'TestUsersController@exeStore')->name('store');

Route::get('/show/{id}', 'TestUsersController@showDetail')->name('detail');

Route::get('/show/edit/{id}', 'TestUsersController@showEdit')->name('edit');

Route::post('/show/update', 'TestUsersController@exeUpdate')->name('update');

Route::post('/show/delete/{id}', 'TestUsersController@exeDelete')->name('delete');

Route::get('/home', 'HomeController@index')->name('home');
