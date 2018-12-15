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
Route::get('/about-us', 'PageController@aboutUs')->name('aboutUs');
Route::get('/user', 'UserController@viewUser')->name('viewUser');
Route::get('/user-view', 'UserController@viewAddUser')->name('viewAddUser');
Route::post('/user-add', 'UserController@addUser')->name('addUser');
