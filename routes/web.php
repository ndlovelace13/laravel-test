<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::post('like/{post}', [App\Http\Controllers\LikesController::class, 'store']);

Route::post('/comment/{post}', [App\Http\Controllers\CommentsController::class, 'store']);

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::get('/p/{post}/delete', [App\Http\Controllers\PostsController::class, 'delete']);
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/followers', [App\Http\Controllers\ProfilesController::class, 'followers'])->name('profile.followers');
Route::get('/profile/{user}/following', [App\Http\Controllers\ProfilesController::class, 'following'])->name('profile.following');