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

Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index'])->name('site.posts');
Route::get('/posts/tags/{tag}', [App\Http\Controllers\TagController::class, 'index'])->name('posts.tags');
Route::get('/posts/create', [App\Http\Controllers\PostsController::class, 'create'])->name('post.create');
Route::get('/posts/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');
Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostsController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}', [App\Http\Controllers\PostsController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('post.delete');


Route::get('/about', function () {
    $name = 'Andrey';
    return view('about', compact('name'));
})->name('site.about');

Route::get('/contacts', function () {
    return view('contacts', ['email' => 'ex@ex.com', 'phone' => '13-13-13']);
})->name('site.contacts');

Route::get('/fead/feedbacks', [App\Http\Controllers\MessageController::class, 'index'])->name('site.feedback');
Route::get('/fead/create', [App\Http\Controllers\MessageController::class, 'create'])->name('feedback.create');
Route::post('/fead', [App\Http\Controllers\MessageController::class, 'store'])->name('feedback.store');

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
