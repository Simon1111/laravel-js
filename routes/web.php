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

Route::resource('/', 'ProductsController', ['only' => ['index', 'show']]);
Route::post('/calc/{product}', 'ProductsController@calc')->name('calc');

Route::post('/add-comment', 'CommentAddController@add');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', 'Admin\IndexController@index')->name('index');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'Admin\UserController@index')->name('index');
        Route::post('/active', 'Admin\UserController@active')->name('active');
        Route::post('/login', 'Admin\UserController@login')->name('login');
        Route::get('/list', 'Admin\UserController@list')->name('list');
        // Route::post('/register', 'Auth\RegisterController@register')->name('register');
    });
});

Auth::routes();

Route::resource('comments', 'CommentsController', ['only' => ['index']]);
Route::get('/api/comments', 'CommentsController@api')->name('api');

Route::resource('items', 'ItemsController');
Route::get('/api/items', 'ItemsController@api')->name('api');