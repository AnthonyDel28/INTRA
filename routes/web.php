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
    if (Auth::check()) {
        return redirect()->route('home');
    }

    return view('pre-page');
})->name('prepage');


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/signup', [App\Http\Controllers\SignupController::class, 'store'])->name('signup');

Route::get('/home', [App\Http\Controllers\MainController::class, 'sections'])->name('home');

Route::post('/publish', [App\Http\Controllers\PostController::class, 'store'])->name('publish');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::post('/posts/like', [App\Http\Controllers\PostController::class, 'like'])->name('posts.like');
Route::post('/post/like', [App\Http\Controllers\PostController::class, 'like_post'])->name('post.like');
Route::delete('/posts/delete/{postId}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

Route::delete('/comment/delete/{commentId}', [App\Http\Controllers\PostController::class, 'deleteComment'])->name('comment.delete');


Route::post('/comments', [App\Http\Controllers\PostController::class, 'postComment'])->name('comments.post');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/{user}', [App\Http\Controllers\UserController::class, 'userProfile'])->name('user.show');



Route::put('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/rapport', [App\Http\Controllers\OtherController::class, 'index'])->name('other.rapport');
Route::post('/rapport/post', [App\Http\Controllers\OtherController::class, 'rapportStore'])->name('other.rapport');

Route::get('/contribute', [App\Http\Controllers\OtherController::class, 'contribute'])->name('other.contribute');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::match(['PUT', 'POST'], '/admin/update/user/{userId}', [App\Http\Controllers\UserController::class, 'adminUserUpdate'])->name('admin.users.update');

Route::get('/success', [App\Http\Controllers\OtherController::class, 'success'])->name('show.badges');

Route::get('/network', [App\Http\Controllers\SocialController::class, 'network'])->name('show.network');

Route::post('/add-friend',  [App\Http\Controllers\SocialController::class, 'addFriend'])->name('add.friend');
Route::post('/accept-friendship', [App\Http\Controllers\SocialController::class, 'acceptFriendship'])->name('friendship.accept');
Route::post('/decline-friendship', [App\Http\Controllers\SocialController::class, 'declineFriendship'])->name('friendship.reject');



Route::get('/notifications', [App\Http\Controllers\MainController::class, 'notifications'])->name('show.notifications');

Route::get('/about', [App\Http\Controllers\MainController::class, 'about'])->name('show.about');

Route::get('/error', [App\Http\Controllers\OtherController::class, 'error'])->name('show.error');




Auth::routes();

Route::get('/home', [App\Http\Controllers\MainController::class, 'sections'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


