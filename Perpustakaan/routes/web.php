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

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->middleware(['auth', 'checkRole:admin,operator,student']);

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::resource('/students', 'StudentsController');
    Route::resource('/books', 'BooksController');
    Route::resource('/operators', 'OperatorsController');
    Route::resource('/class', 'ClassController');
    Route::get('/class/getDataDepartment/{id}', 'ClassController@getDataDepartment');
    Route::get('/class/getDataGrade/{id}', 'ClassController@getDataGrade');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,operator']], function () {
    Route::get('/transaction', 'TransactionController@borrowingBook');
    Route::post('/transaction', 'TransactionController@process');
    Route::get('/transaction/getStudents', 'StudentsController@getStudents');
    Route::get('/transaction/getBooks', 'BooksController@getBooks');
    Route::get('/report', 'TransactionController@report');
    Route::delete('transaction/{transaction}', 'TransactionController@destroy');
    Route::get('/profile_operator/{operator}', 'OperatorsController@show');
});


Route::group(['middleware' => ['auth', 'checkRole:student']], function () {
    Route::get('/profile_student/{id}', 'StudentsController@myProfile');
});

Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
