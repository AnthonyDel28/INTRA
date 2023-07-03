<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role_id == 3) {
            return redirect()->route('home');
        }
        $news = DB::table('news')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->select('news.*', 'users.name as user_name')
            ->get();

        $posts = DB::table('posts')
            ->join('users', 'posts.author', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name')
            ->get();
        $comments = DB::table('comments')
            ->join('users', 'comments.author', '=', 'users.id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('comments.*', 'users.name as author_name', 'posts.title as post_title')
            ->get();

        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->get();

        $reports = DB::table('rapports')
            ->leftJoin('users', 'rapports.user_id', '=', 'users.id')
            ->select('rapports.*', 'users.name')
            ->get();


        return view('admin.admin', compact('news', 'posts', 'comments', 'users', 'reports'));
    }
}
