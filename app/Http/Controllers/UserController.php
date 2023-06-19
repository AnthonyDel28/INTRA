<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        $badges = DB::table('users_badges')
            ->join('badges', 'users_badges.badge_id', '=', 'badges.id')
            ->where('users_badges.user_id', $userId)
            ->select('badges.*')
            ->get();

        return view('user.profile', compact('user', 'badges'));
    }


    public function userProfile(User $user)
    {
        $userId = $user->id;

        $badges = DB::table('badges')
            ->join('users_badges', 'badges.id', '=', 'users_badges.badge_id')
            ->where('users_badges.user_id', $userId)
            ->select('badges.*')
            ->get();

        $loggedInUserId = Auth::user()->id;
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author')
            ->leftJoin('likes', function ($join) use ($loggedInUserId) {
                $join->on('posts.id', '=', 'likes.post_id')
                    ->where('likes.user_id', '=', $loggedInUserId);
            })
            ->select(
                'posts.id as post_id',
                'posts.title',
                'posts.author',
                'posts.message',
                'posts.code',
                'posts.created_at',
                'posts.updated_at',
                'posts.is_active',
                'posts.section_id',
                'posts.language',
                'users.*',
                'users.image as author_image',
                'posts.created_at as post_created_at',
                DB::raw('(SELECT COUNT(*) FROM likes WHERE post_id = posts.id) as likes'),
                DB::raw('(CASE WHEN likes.user_id = '.$loggedInUserId.' THEN 1 ELSE 0 END) as isLiked')
            )
            ->where('posts.author', $user->id)
            ->latest('posts.created_at')
            ->get();

        return view('user.show', compact('user', 'badges', 'posts'));
    }



    public function update(Request $request)
    {
        $userId = auth()->id();
        $user = User::find($userId);

        $user->name = $request->input('name');
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

    public function adminUserUpdate(Request $request, $userId)
    {

        $name = $request->input('name');
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');
        $roleId = $request->input('role');

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'name' => $name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'role_id' => $roleId
            ]);

        return redirect()->back()->with('success_user_update', 'Profil mis à jour avec succès.');
    }

}
