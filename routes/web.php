<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'PostsController@index');

Route::get('/about', function () {
    $name = 'Andrey';
    return view('about', compact('name'));
});

Route::get('/contacts', function () {
    return view('contacts', ['email' => 'ex@ex.com', 'phone' => '13-13-13']);
});

Route::get('/posts/create', 'PostsController@create');
// {article} - unique ID of article
Route::get('/posts/{post}', 'PostsController@show');

Route::post('/posts', 'PostsController@store');


Route::get('/admin/feedbacks', 'MessageController@index');
Route::get('/admin/create', 'MessageController@create');
Route::post('/admin', 'MessageController@store');

/**
 * GET /article
 * GET /article/create
 * POST /article
 *
 * show
 * GET /article/{article}
 * edit
 * GET /article/{article}/edit
 *
 * update
 * PATCH /article/{article}
 * delete
 * DELETE /article/{article}
 */