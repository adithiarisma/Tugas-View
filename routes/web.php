<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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

Route::get('/', 'App\Http\Controllers\PagesController@home');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/contact', 'App\Http\Controllers\PagesController@contact');
Route::get('/books', 'App\Http\Controllers\BooksController@index');
Route::get('/books/create', 'App\Http\Controllers\BooksController@create');
Route::get('/books/{book}', 'App\Http\Controllers\BooksController@show');
Route::post('/books', 'App\Http\Controllers\BooksController@store');
Route::delete('/books/{book}', 'App\Http\Controllers\BooksController@destroy');
Route::get('/books/{book}/edit', 'App\Http\Controllers\BooksController@edit');
Route::patch('/books/{book}', 'App\Http\Controllers\BooksController@update');