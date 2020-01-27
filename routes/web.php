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

// GET routes
Route::get('/home', 'MessagesController@index')->name('home');
Route::get('/create/{id?}/{subject?}', 'MessagesController@create')->name('create');
Route::get('/sent', 'MessagesController@sent')->name('sent-messages');
Route::get('/read/{id}', 'MessagesController@read')->name('read');

// POST routes
Route::post('/send', 'MessagesController@send')->name('send');
