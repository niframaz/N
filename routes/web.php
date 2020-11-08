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
Route::get('message/{user}/create', '\App\Http\Controllers\MessageController@create');
Route::post('message/{user}', '\App\Http\Controllers\MessageController@store');

Route::post('like/{post}', '\App\Http\Controllers\LikeController@store');
Route::get('post/{post}/likes', '\App\Http\Controllers\LikeController@likes');

Route::post('post/{post}/{user}/comment', '\App\Http\Controllers\CommentController@store');
Route::delete('comment/{comment}', '\App\Http\Controllers\CommentController@delete');

Route::get('profile/{profile}/followers', '\App\Http\Controllers\FollowController@followers');
Route::get('profile/{user}/following', '\App\Http\Controllers\FollowController@following');
Route::post('follow/{profile}', '\App\Http\Controllers\FollowController@store');

Route::get('profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::get('profile/{user}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::patch('profile/{user}', [App\Http\Controllers\ProfileController::class, 'update']);

Route::get('post/create', 'App\Http\Controllers\PostController@create');
Route::get('post/{post}/edit', 'App\Http\Controllers\PostController@edit');
Route::get('post/{post}', [App\Http\Controllers\PostController::class, 'show']);
Route::patch('post/{post}', [App\Http\Controllers\PostController::class, 'update']);
Route::delete('post/{post}', [App\Http\Controllers\PostController::class, 'delete']);
Route::post('post/', 'App\Http\Controllers\PostController@store');
Route::get('/', 'App\Http\Controllers\PostController@index')->name('home');
