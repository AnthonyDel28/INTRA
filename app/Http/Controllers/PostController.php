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
}
