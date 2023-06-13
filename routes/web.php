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

Route::get('/', function () {
    return view('pre-page');
})->name('prepage');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/signup', [App\Http\Controllers\SignupController::class, 'store'])->name('signup');

Route::get('/home', [App\Http\Controllers\MainController::class, 'sections'])->name('home');

Route::post('/publish', [App\Http\Controllers\PostController::class, 'store'])->name('publish');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::post('/posts/like', [App\Http\Controllers\PostController::class, 'like'])->name('posts.like');
