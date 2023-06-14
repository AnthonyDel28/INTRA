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
            ->leftJoin('likes', function ($join) use ($user) {
                $join->on('posts.id', '=', 'likes.post_id')
                    ->where('likes.user_id', '=', $user->id);
            })
            ->select(
                'posts.id as post_id',
                'posts.title',
                'posts.author',
                'posts.message',
                'posts.code',
                'posts.created_at',
                'posts.updated_at',
                'posts.is_active',
                'posts.section_id',
                'posts.language',
                'users.*',
                'users.image as author_image',
                'posts.created_at as post_created_at',
                DB::raw('(SELECT COUNT(*) FROM likes WHERE post_id = posts.id) as likes'),
                DB::raw('(SELECT likes.id FROM likes WHERE post_id = posts.id AND user_id = '.$user->id.') as isLiked')
            )
            ->latest('posts.created_at')
            ->limit(4)
            ->get();

        $languages = [
            'Bash',
            'C',
            'C#',
            'C++',
            'CSS',
            'Diff',
            'Go',
            'GraphQL',
            'HTML',
            'XML',
            'JSON',
            'Java',
            'JavaScript',
            'Kotlin',
            'Less',
            'Lua',
            'Makefile',
            'Markdown',
            'Objective-C',
            'PHP',
            'PHP Template',
            'Perl',
            'Plain text',
            'Python',
            'Python REPL',
            'R',
            'Ruby',
            'Rust',
            'SCSS',
            'SQL',
            'Shell',
            'Session',
            'Swift',
            'TOML',
            'INI',
            'TypeScript',
            'Visual Basic .NET',
            'WebAssembly',
            'YAML',
        ];


        return view('home', compact('sections', 'posts', 'languages'));
    }

}
