<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Support\Str;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'name' =>  '@' . $validatedData['first_name'] . $validatedData['last_name'] ,
            'role_id' => 3,
            'is_active' => 1,
            'experience' => 0,
            'level' => 1,
            'avatar' => 'default.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'gender' => '/',
            'status' => 1,
            'remember_token' => Str::random(10),
            'dark_mode' => 1
        ]);
        auth()->login($user);
        //$user->notify(new UserRegisteredNotification($user));
        return redirect()->route('home');
    }
}
