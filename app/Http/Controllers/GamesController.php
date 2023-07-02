<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GamesController extends Controller
{
    public function games()
    {
        return view('games.games');
    }

    public function snake()
    {
        return view('games.snake');
    }

    public function scoreStore(Request $request)
    {
        $validatedData = $request->validate([
            'score' => 'required|integer',
        ]);

        DB::table('scores')->insert([
            'score' => $validatedData['score'],
            'user_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Score enregistré avec succès']);
    }

    public function snakeScores(Request $request)
    {
        $scores = DB::table('scores')
            ->join('users', 'scores.user_id', '=', 'users.id')
            ->orderBy('scores.score', 'desc')
            ->select('scores.*', 'users.name as username')
            ->get();

        return view('games.snakeScores', ['scores' => $scores]);
    }
}
