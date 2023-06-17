<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SocialController extends Controller
{
    public function network(Request $request){
            $users = DB::table('users')->get();
            return view('social.network', ['users' => $users]);
    }

    public function addFriend(Request $request){

        $request->validate([
            'userId' => 'required|integer',
        ]);

        DB::table('friendships')->insert([
            'user_id' => auth()->user()->id,
            'friend_id' => $request->userId,
            'created_at' => now(),
            'updated_at' => now(),
            'confirm' => 0
        ]);

        DB::table('notifications')->insert([
            'user_id' => $request->userId,
            'message' => auth()->user()->last_name . ' ' . auth()->user()->first_name . ' vous a envoyé un invitation!',
            'read' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'Invitation envoyée!'], 200);

    }
    /*
    public function notifications(Request $request){


        return view('social.notifications', ['notifications' => $notifications]);
    }*/
}
