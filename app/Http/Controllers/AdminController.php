<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $news = DB::table('news')->get();
        $posts = DB::table('posts')
            ->join('users', 'posts.author', '=', 'users.id')
            ->select('posts.*', 'users.username as user_name')
            ->get();
        $comments = DB::table('comments')
            ->join('users', 'comments.author', '=', 'users.id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('comments.*', 'users.username as author_name', 'posts.title as post_title')
            ->get();

        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name')
            ->get();

        $reports = DB::table('rapports')
            ->join('users', 'rapports.user_id', '=', 'users.id')
            ->select('rapports.*', 'users.username')
            ->get();


        return view('admin.admin', compact('news', 'posts', 'comments', 'users', 'reports'));
    }
}