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
}
