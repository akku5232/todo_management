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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('todos/save','TodoController@todos_save')->name('todos.save');

Route::get('/','TodoController@todos_index')->name('todos.index');

Route::get('todos/delete','TodoController@todos_delete')->name('todos.delete');
