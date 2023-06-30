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
            ->where('title', 'like', '%'.$query.'%')
            ->orWhere('message', 'like', '%'.$query.'%')
            ->get();
        $comments = DB::table('comments')
            ->where('message', 'like', '%'.$query.'%')
            ->get();

        return view('search.results', compact('users', 'posts', 'comments'));

    }


}
