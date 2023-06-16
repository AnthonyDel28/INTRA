<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OtherController extends Controller
{
    public function index(Request $request){
        return view('other.rapport');
    }
    public function rapportStore(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        DB::table('rapports')->insert([
            'title' => $validatedData['title'],
            'message' => $validatedData['message'],
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Le rapport a été soumis avec succès.');
    }

    public function contribute()
    {
        $client = new Client();
        $response = $client->get('https://api.github.com/repos/AnthonyDel28/INTRA/contents');
        $contents = json_decode($response->getBody(), true);

        return view('other.contribute', ['contents' => $contents]);
    }
}
