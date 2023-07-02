<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class PostController extends Controller
{

    public function store(Request $request)
    {
        $user = auth()->user();

        $postCount = DB::table('posts')
            ->where('author', $user->id)
            ->whereDate('created_at', DB::raw('CURDATE()'))
            ->count();

        $maxPostsPerDay = 2;

        if ($postCount >= $maxPostsPerDay) {
            $username = $user->name;

            DB::table('rapports')->insert([
                'title' => 'Concerne ' . $username,
                'message' => 'Spamming de publications potentiel.',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $roles = [1, 2];
            $users = DB::table('users')
                ->whereIn('role_id', $roles)
                ->get();

            foreach ($users as $notifiedUser) {
                DB::table('notifications')->insert([
                    'user_id' => $notifiedUser->id,
                    'message' => 'Une nouvelle alerte de spamming a été lancée!',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'type' => 0,
                ]);
            }
        }


        $validatedData = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'section_id' => 'required',
            'language' => 'nullable',
            'code' => 'nullable',
        ]);

        $validatedData['author'] = $user->id;
        $validatedData['is_active'] = 1;
        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        DB::table('posts')->insert($validatedData);

        return redirect()->route('home')->with('success_post', 'Votre contenu a été publié');
    }


    public function show($id)
    {
        $post = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author')
            ->join('sections', 'sections.id', '=', 'posts.section_id')
            ->select('posts.*', 'posts.id as post_id', 'users.*', 'users.avatar as author_image', 'posts.created_at as post_created_at', 'sections.name as section_name')
            ->where('posts.id', $id)
            ->first();

        $userId = auth()->id();
        $isLiked = DB::table('likes')->where('post_id', $id)->where('user_id', $userId)->exists();
        $likes = DB::table('likes')
            ->where('post_id', $id)
            ->count();

        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.author')
            ->where('comments.post_id', $id)
            ->select('comments.*', 'users.first_name', 'users.last_name', 'users.avatar as user_image')
            ->get();


        return view('posts.show', compact('post', 'likes', 'isLiked', 'comments'));
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

    public function like_post(Request $request)
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



    public function postComment(Request $request)
    {
        $user = auth()->user();

        $commentCount = DB::table('comments')
            ->where('author', $user->id)
            ->whereDate('created_at', DB::raw('CURDATE()'))
            ->count();

        $maxCommentsPerDay = 3;

        if ($commentCount >= $maxCommentsPerDay) {
            $username = $user->name;

            DB::table('rapports')->insert([
                'title' => 'Concerne ' . $username,
                'message' => 'Spamming de commentaires potentiel.',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $roles = [1, 2];
            $users = DB::table('users')
                ->whereIn('role_id', $roles)
                ->get();

            foreach ($users as $notifiedUser) {
                DB::table('notifications')->insert([
                    'user_id' => $notifiedUser->id,
                    'message' => 'Une nouvelle alerte de spamming a été lancée!',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'type' => 0,
                ]);
            }
        }

        $userId = Auth::id();
        $message = $request->input('message');
        $code = $request->input('code');
        $postId = $request->input('post_id');


        $code = Str::replace(['{{', '}}'], ['{ {', '} }'], $code);

        DB::table('comments')->insert([
            'message' => $message,
            'code' => $code,
            'author' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
            'is_active' => 1,
            'post_id' => $postId
        ]);

        return redirect()->back()->with('success_comment', 'Commentaire ajouté avec succès.');
    }


    public function delete($postId)
    {
        $post = DB::table('posts')->where('id', $postId)->first();

        if ($post) {
            DB::table('comments')->where('post_id', $postId)->delete();
            DB::table('posts')->where('id', $postId)->delete();

            return redirect()->route('home')->with('success_delete', 'Votre contenu a été supprimé');
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    public function deleteComment($commentId)
    {
        $comment = DB::table('comments')->where('id', $commentId)->first();

        if ($comment) {
            DB::table('comments')->where('id', $commentId)->delete();

            return response()->json(['message' => 'Comment deleted successfully']);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }
}
