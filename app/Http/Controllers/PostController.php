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
        $userId = Auth::id();

        $existingLike = DB::table('likes')->where('post_id', $postId)->where('user_id', $userId)->first();

        if ($existingLike) {
            DB::table('likes')->where('post_id', $postId)->where('user_id', $userId)->delete();

            return response()->json(['success' => true, 'message' => 'Post unliked']);
        }

        DB::table('likes')->insert([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        return response()->json(['success' => true, 'message' => 'Post liked']);
    }


}
