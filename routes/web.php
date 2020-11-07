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


Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/posts/tags/{tag}', [App\Http\Controllers\TagController::class, 'index']);
Route::get('/posts/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/posts/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostsController::class, 'edit']);
Route::patch('/posts/{post}', [App\Http\Controllers\PostsController::class, 'update']);
Route::delete('/posts/{post}', [App\Http\Controllers\PostsController::class, 'destroy']);


Route::get('/about', function () {
    $name = 'Andrey';
    return view('about', compact('name'));
});

Route::get('/contacts', function () {
    return view('contacts', ['email' => 'ex@ex.com', 'phone' => '13-13-13']);
});

Route::get('/fead/feedbacks', [App\Http\Controllers\MessageController::class, 'index']);
Route::get('/fead/create', [App\Http\Controllers\MessageController::class, 'create']);
Route::post('/fead', [App\Http\Controllers\MessageController::class, 'store']);

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
