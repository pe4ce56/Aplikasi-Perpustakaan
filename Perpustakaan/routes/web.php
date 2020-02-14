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
Route::get('/API/students', 'API\StudentsController@index');
Route::get('/API/books', 'API\BooksController@index');

Route::get('/', 'TransactionController@index');
Route::get('/transaction', 'TransactionController@index');
Route::post('/transaction','TransactionController@store');

Route::get('/dataStudent', 'DataStudentsController@index');
Route::delete('/dataStudent/{student}', 'DataStudentsController@destroy');
