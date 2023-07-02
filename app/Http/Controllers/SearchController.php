<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = DB::table('users')
            ->where('name', 'like', '%'.$query.'%')
            ->orWhere('first_name', 'like', '%'.$query.'%')
            ->orWhere('last_name', 'like', '%'.$query.'%')
            ->get();

        $posts = DB::table('posts')
            ->join('users', 'posts.author', '=', 'users.id')
            ->where(function ($postQuery) use ($query) {
                $postQuery->where('users.name', 'like', '%'.$query.'%')
                    ->orWhere('users.first_name', 'like', '%'.$query.'%')
                    ->orWhere('users.last_name', 'like', '%'.$query.'%')
                    ->orWhere('posts.title', 'like', '%'.$query.'%')
                    ->orWhere('posts.message', 'like', '%'.$query.'%');
            })
            ->get();

        $comments = DB::table('comments')
            ->join('users', 'comments.author', '=', 'users.id')
            ->select('users.*', 'comments.*', 'comments.id as comment_id')
            ->where('comments.message', 'like', '%'.$query.'%')
            ->orWhere('users.name', 'like', '%'.$query.'%')
            ->get();

        return view('search.results', compact('users', 'posts', 'comments'));
    }
}
