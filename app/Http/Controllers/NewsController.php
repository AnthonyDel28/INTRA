<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    public function news(Request $request)
    {
        $news = DB::table('news')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->select('news.*', 'users.name as user_name')
            ->orderBy('news.created_at', 'desc')
            ->get();

        return view('social.news', ['news' => $news]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        $image = $request->file('image');
        $userId = Auth::id();

        $imagePath = null;
        if ($image) {
            $imagePath = $image->store('news', 'public');
            $imagePath = basename($imagePath);
        }

        DB::table('news')->insert([
            'title' => $title,
            'content' => $content,
            'image' => $imagePath,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success_news_store', 'Actualité postée avec succès.');
    }

    public function deleteNews($newsId)
    {
        $news = DB::table('news')->where('id', $newsId)->first();

        if ($news) {
            DB::table('news')->where('id', $newsId)->delete();

            return response()->json(['message' => 'News deleted successfully']);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }

    public function delete($id)
    {
        if (in_array(auth()->user()->role_id, [1, 2])) {
            DB::table('news')->where('id', $id)->delete();
            return redirect()->route('show.news')->with('success_delete', 'Votre contenu a été supprimé');
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas la permission de supprimer cette news.')->with('status', 403);
        }
    }
}
