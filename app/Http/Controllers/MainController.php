<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function sections()
    {
        $user = Auth::user();
        $sections = DB::table('sections')->get();
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'users.*', 'users.image as author_image', 'posts.created_at as post_created_at')
            ->selectRaw('(SELECT COUNT(*) FROM posts_likes WHERE post_id = posts.id AND user_id = ?) as isLikedByUser', [$user->id])
            ->latest('posts.created_at')
            ->limit(4)
            ->get();

        return view('home', compact('sections', 'posts'));
    }


}
