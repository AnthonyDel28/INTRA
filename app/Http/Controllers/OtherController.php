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

        return redirect()->route('home')->with('success_post', 'Votre rapport a été envoyé, merci.');
    }

    public function contribute()
    {
        $client = new Client();
        $response = $client->get('https://api.github.com/repos/AnthonyDel28/INTRA/contents');
        $contents = json_decode($response->getBody(), true);

        return view('other.contribute', ['contents' => $contents]);
    }

    public function success(Request $request)
    {
        $badges = DB::table('badges')->get();

        return view('other.success', ['badges' => $badges]);
    }

    public function error(){
        return view('other.error');
    }
}
