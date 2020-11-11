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

Auth::routes();

Route::get('messages/', '\App\Http\Controllers\MessageController@index');
Route::post('message/{user}', '\App\Http\Controllers\MessageController@store');
Route::get('message/{user}', '\App\Http\Controllers\MessageController@create');

Route::post('like/{post}', '\App\Http\Controllers\LikeController@store');

Route::get('post/create', 'App\Http\Controllers\PostController@create');
Route::get('post/{post}', [App\Http\Controllers\PostController::class, 'show']);
Route::patch('post/{post}', [App\Http\Controllers\PostController::class, 'update']);
Route::delete('post/{post}', [App\Http\Controllers\PostController::class, 'delete']);
Route::get('post/{post}/likes', '\App\Http\Controllers\LikeController@likes');
Route::get('post/{post}/edit', 'App\Http\Controllers\PostController@edit');
Route::post('post/{post}/{user}/comment', '\App\Http\Controllers\CommentController@store');
Route::post('post/', 'App\Http\Controllers\PostController@store');

Route::delete('comment/{comment}', '\App\Http\Controllers\CommentController@delete');

Route::patch('profile/', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/', 'App\Http\Controllers\PostController@index')->name('home');

Route::post('follow/{profile}', '\App\Http\Controllers\FollowController@store');

Route::delete('{message}', '\App\Http\Controllers\MessageController@delete');

Route::get('{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('{user}/followers', '\App\Http\Controllers\FollowController@followers')->name('followers');
Route::get('{user}/following', '\App\Http\Controllers\FollowController@following');
