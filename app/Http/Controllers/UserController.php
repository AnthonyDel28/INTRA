<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile()
    {
        $userId = auth()->id();
        $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $userId)
            ->select('users.*', 'roles.name as role')
            ->first();

        return view('user.profile', compact('user'));
    }


    public function update(Request $request)
    {
        $userId = auth()->id();
        $user = User::find($userId);

        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->gender = $request->input('gender');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $userId . '.jpg';
            $image->storeAs('public/images/users/profile', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }

}
