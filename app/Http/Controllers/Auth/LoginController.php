<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            print 'hello';
        }

        // L'authentification a échoué, redirigez l'utilisateur vers la page de connexion avec une erreur
        return redirect()->route('prepage')->with('error', 'Données incorrectes, veuillez réessayer!');
    }
}
