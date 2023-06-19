<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function sections()
    {
        $user = Auth::user();
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author')
            ->leftJoin('likes', function ($join) use ($user) {
                $join->on('posts.id', '=', 'likes.post_id')
                    ->where('likes.user_id', '=', $user->id);
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
                'users.avatar as author_image',
                'posts.created_at as post_created_at',
                DB::raw('(SELECT COUNT(*) FROM likes WHERE post_id = posts.id) as likes'),
                DB::raw('(SELECT likes.id FROM likes WHERE post_id = posts.id AND user_id = '.$user->id.') as isLiked')
            )
            ->latest('posts.created_at')
            ->limit(4)
            ->get();
        $friends = DB::table('friendships')
            ->join('users', 'friendships.friend_id', '=', 'users.id')
            ->where('friendships.user_id', $user->id)
            ->where('friendships.confirm', 1)
            ->select('users.*')
            ->take(5)
            ->get();
        return view('home', compact('posts', 'user', 'friends' ));
    }

    public function notifications(Request $request)
    {
        $user = Auth::user();

        $notifications = DB::table('notifications')
            ->leftJoin('friendships', 'notifications.friendship', '=', 'friendships.id')
            ->where('notifications.user_id', $user->id)
            ->orderBy('notifications.created_at', 'desc')
            ->get();
        $this->markAllNotificationsAsRead();
        return view('user.notifications', compact('notifications'));
    }

    public function markAllNotificationsAsRead()
    {
        $user = Auth::user();

        DB::table('notifications')
            ->where('user_id', $user->id)
            ->update(['read' => 1]);
    }

    public function about(){
        return view('other.about');
    }
}
