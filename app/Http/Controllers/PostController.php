<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'section_id' => 'required',
            'code' => 'required',
        ]);

        $validatedData['author'] = Auth::id();
        $validatedData['is_active'] = 1;
        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();
        $validatedData['likes'] = 0;
        DB::table('posts')->insert($validatedData);

       return redirect()->route('home')->with('success_post', 'Votre contenu a été publié');
    }

    public function show($id)
    {
        $sections = DB::table('sections')->get();
        $post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author')
            ->select('posts.*', 'users.*', 'users.image as author_image', 'posts.created_at as post_created_at')
            ->where('posts.id', $id)
            ->first();

        return view('posts.show', compact('post', 'sections'));
    }

    public function like(Request $request)
    {
        $postId = $request->input('postId');
        DB::table('posts')
            ->where('id', $postId)
            ->increment('likes', 1);

        return response()->json(['success' => true, 'message' => 'Post liked']);
    }

}
