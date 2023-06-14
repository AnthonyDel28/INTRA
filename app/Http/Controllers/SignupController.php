<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'username' =>  explode('@', $validatedData['email'])[0],
            'role_id' => 3,
            'is_active' => 1,
            'experience' => 0,
            'level' => 0,
            'image' => 'default.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'gender' => '/',
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}
