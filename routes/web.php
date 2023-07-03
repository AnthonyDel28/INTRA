<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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


Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user && $user->is_active == 0) {
        return redirect()->route('prepage')->withErrors([
            'failed' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.',
        ]);
    }

    if (Auth::attempt($credentials)) {
        return redirect()->route('home');
    }

    return redirect()->route('prepage')->withErrors([
        'failed' => 'Données de connexion incorrectes!',
    ]);
})->name('login');


Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/signup', [App\Http\Controllers\SignupController::class, 'store'])->name('signup');

Route::get('/home', [App\Http\Controllers\MainController::class, 'sections'])
    ->name('home')
    ->middleware('redirectIfNotAuthenticated');

Route::delete('/news/{id}', [App\Http\Controllers\NewsController::class, 'delete'])->name('news.remove');

Route::post('/publish', [App\Http\Controllers\PostController::class, 'store'])->name('publish');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::post('/posts/like', [App\Http\Controllers\PostController::class, 'like'])->name('posts.like');
Route::post('/post/like', [App\Http\Controllers\PostController::class, 'like_post'])->name('post.like');
Route::delete('/posts/delete/{postId}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

Route::delete('/comment/delete/{commentId}', [App\Http\Controllers\PostController::class, 'deleteComment'])->name('comment.delete');


Route::post('/comments', [App\Http\Controllers\PostController::class, 'postComment'])->name('comments.post');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/{user}', [App\Http\Controllers\UserController::class, 'userProfile'])->name('user.show');


Route::put('/users/{id}/disable', [App\Http\Controllers\UserController::class, 'disable'])->name('user.disable');
Route::put('/users/{id}/reactivate', [App\Http\Controllers\UserController::class, 'reactivate'])->name('user.reactivate');
Route::put('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/rapport', [App\Http\Controllers\OtherController::class, 'index'])->name('other.rapport');
Route::post('/rapport/post', [App\Http\Controllers\OtherController::class, 'rapportStore'])->name('other.rapport');

Route::get('/contribute', [App\Http\Controllers\OtherController::class, 'contribute'])->name('other.contribute');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/update/user/{userId}', [App\Http\Controllers\UserController::class, 'adminUserUpdate'])->name('admin.users.update');

Route::get('/success', [App\Http\Controllers\OtherController::class, 'success'])->name('show.badges');

Route::get('/news', [App\Http\Controllers\NewsController::class, 'news'])->name('show.news');
Route::post('/add-news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
Route::delete('/news/delete/{newsId}', [App\Http\Controllers\NewsController::class, 'deleteNews'])->name('news.delete');

Route::get('/network', [App\Http\Controllers\SocialController::class, 'network'])->name('show.network');

Route::post('/add-friend',  [App\Http\Controllers\SocialController::class, 'addFriend'])->name('add.friend');
Route::post('/accept-friendship', [App\Http\Controllers\SocialController::class, 'acceptFriendship'])->name('friendship.accept');
Route::post('/decline-friendship/', [App\Http\Controllers\SocialController::class, 'declineFriendship'])->name('friendship.reject');
Route::post('/delete-friend/', [App\Http\Controllers\SocialController::class, 'deleteFriend'])->name('friendship.delete');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');


Route::get('/notifications', [App\Http\Controllers\MainController::class, 'notifications'])->name('show.notifications');

Route::get('/about', [App\Http\Controllers\MainController::class, 'about'])->name('show.about');

Route::get('/error', [App\Http\Controllers\OtherController::class, 'error'])->name('show.error');


Route::get('/home', [App\Http\Controllers\MainController::class, 'sections'])->name('home');


Route::get('/games', [App\Http\Controllers\GamesController::class, 'games'])->name('games');
Route::get('/snake', [App\Http\Controllers\GamesController::class, 'snake'])->name('snake');
Route::get('/snakeScores', [App\Http\Controllers\GamesController::class, 'snakeScores'])->name('snakeScores');
Route::post('/scoreStore', [App\Http\Controllers\GamesController::class, 'scoreStore'])->name('scoreStore');

Route::get('/friends', [App\Http\Controllers\SocialController::class, 'friends'])->name('friends');
Route::get('/getContacts', [App\Http\Controllers\Vendor\MessagesController::class, 'getContacts']);


