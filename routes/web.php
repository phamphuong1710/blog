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

Route::get('/', 'ShowController@index');

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoryController');

Route::resource('posts', 'PostController');

Route::resource('show', 'ShowController');
Route::post('star', 'ShowController@star')->name('star');

Route::resource('comment', 'CommentController');

Route::resource('rating', 'RatingController');
