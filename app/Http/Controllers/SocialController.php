<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function network(Request $request){
        $users = DB::table('users')->get();
        return view('social.network', ['users' => $users]);
    }

    public function messenger(Request $request){
        return view('social.chat');
    }

    public function addFriend(Request $request)
    {

        $request->validate([
            'userId' => 'required|integer',
        ]);

        $existingFriendship = DB::table('friendships')
            ->where('user_id', auth()->user()->id)
            ->where('friend_id', $request->userId)
            ->first();

        if (!$existingFriendship) {
            $friendshipId = DB::table('friendships')->insertGetId([
                'user_id' => auth()->user()->id,
                'friend_id' => $request->userId,
                'created_at' => now(),
                'updated_at' => now(),
                'confirm' => 0,
            ]);

            $existingNotification = DB::table('notifications')
                ->where('user_id', $request->userId)
                ->where('author_id', auth()->user()->id)
                ->where('type', 1)
                ->first();
            if ($existingNotification) {
                DB::table('notifications')
                    ->where('id', $existingNotification->id)
                    ->delete();
            }
            DB::table('notifications')->insert([
                'user_id' => $request->userId,
                'author_id' => auth()->user()->id,
                'friendship' => $friendshipId,
                'message' => auth()->user()->last_name . ' ' . auth()->user()->first_name . ' vous a envoyé une invitation!',
                'read' => 0,
                'type' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['message' => 'Invitation envoyée!'], 200);

        }
    }

    public function acceptFriendship(Request $request)
    {
        $friendshipId = $request->input('friendshipId');
        $notificationId = $request->input('notificationId');

        $friendship = DB::table('friendships')
            ->where('id', $friendshipId)
            ->first();

        if (!$friendship) {
            return response()->json(['success' => false, 'message' => 'Friendship not found']);
        }

        $newFriendship = [
            'user_id' => $friendship->friend_id,
            'friend_id' => $friendship->user_id,
            'confirm' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $newFriendshipId = DB::table('friendships')->insertGetId($newFriendship);

        if (!$newFriendshipId) {
            return response()->json(['success' => false, 'message' => 'Failed to create new friendship']);
        }

        $updated = DB::table('friendships')
            ->where('id', $friendshipId)
            ->update(['confirm' => 1]);

        if ($updated) {
            $notification = [
                'author_id' => auth()->user()->id,
                'user_id' => $friendship->user_id,
                'message' => auth()->user()->first_name . ' ' . auth()->user()->last_name . ' a accepté votre invitation.',
                'type' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('ch_favorites')->insert([
                'id' => uniqid(),
                'user_id' => auth()->user()->id,
                'favorite_id' => $friendship->user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('ch_favorites')->insert([
                'id' => uniqid(),
                'user_id' => $friendship->user_id,
                'favorite_id' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $notificationId = DB::table('notifications')->insertGetId($notification);

            if (!$notificationId) {
                return response()->json(['success' => false, 'message' => 'Failed to create new notification']);
            }


            return response()->json(['success' => true, 'message' => 'Friendship accepted']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update friendship']);
    }



    public function declineFriendship(Request $request)
    {
        $friendshipId = $request->input('friendshipId');

        $deleted = DB::table('friendships')
            ->where('id', $friendshipId)
            ->delete();
        $deletedNotifications = DB::table('notifications')
            ->where('friendship', $friendshipId)
            ->delete();
        if ($deleted || $deletedNotifications) {
            return response()->json(['success' => true, 'message' => 'Friendship declined']);
        }

        return response()->json(['success' => false, 'message' => 'Friendship not found']);
    }


    public function deleteFriend(Request $request)
    {
        $userId = Auth::user()->id;
        $friendId = $request->input('userId');

        DB::table('friendships')
            ->where(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $userId)
                    ->where('friend_id', $friendId);
            })
            ->orWhere(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('friend_id', $userId);
            })
            ->delete();

        DB::table('notifications')
            ->where(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $userId)
                    ->where('author_id', $friendId);
            })
            ->orWhere(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('author_id', $userId);
            })
            ->delete();

        DB::table('ch_favorites')
            ->where(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $userId)
                    ->where('favorite_id', $friendId);
            })
            ->orWhere(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('favorite_id', $userId);
            })
            ->delete();

        return response()->json(['message' => 'Ami supprimé avec succès.']);
    }
}
