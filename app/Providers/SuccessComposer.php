<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class SuccessComposer
{
    public function compose($view)
    {
        $user = Auth::check() ? Auth::user() : null;

        /*
            1 - Admin - Administrateur - Avoir le rôle Administrateur
            2 - Champion - Champion - Être champion d'un jeu
            3 - Commentor - Commentor - Avoir publié au moins dix commentaires
            4 - Contributor - Contributeur - Avoir contribué au dépôt Github
            5 - 5 Amis - Amical - Avoir au moins 5 amis
            6 - 10 Amis - Populaire - Avoir au moins 10 amis
            7 - Gamer - Joueur - Avoir une place dans les classements de tous nos jeux
            8 - Niveau 5 - Niveau 5 - Atteindre le niveau 5
            9 - Niveau 10 - Niveau 10 - Atteindre le niveau 10
            10 - Niveau 20 - Niveau 20 - Atteindre le niveau 20
            11 - Liked - Apprécié - Avoir au moins 10 likes sur l'ensemble de ses posts
            12 - Publisher - Publieur - Avoir publié au moins 5 posts
            13 - Reporter - Rapporteur - Avoir publié au moins 5 rapports
            14 - Validate - Validé - Compte validé
        */


        if($user){
            if ($user && $user->role_id === 1) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 1)
                    ->first();

                if (!$existingBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 1,
                    ]);
                }
            }
            /*---------------------------------------------------------------*/

            $commentCount = DB::table('comments')
                ->where('author', $user->id)
                ->count();

            if ($commentCount >= 10) {
                $commentBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 3)
                    ->first();

                if (!$commentBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 3,
                    ]);
                }
            }

            /*-------------------------------------------------------------*/

            $friendshipCount = DB::table('friendships')
                ->where('user_id', $user->id)
                ->count();

            if ($friendshipCount >= 5) {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 5)
                    ->first();

                if (!$friendshipBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 5,
                    ]);
                }
            }

            /*-------------------------------------------------------------*/

            $friendshipCount = DB::table('friendships')
                ->where('user_id', $user->id)
                ->count();

            if ($friendshipCount >= 10) {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 6)
                    ->first();

                if (!$friendshipBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 6
                    ]);
                }
            }

            /*--------------------------------------------------------------*/

            if ($user && $user->level >= 5) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 8)
                    ->first();

                if (!$existingBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 8,
                    ]);
                }
            }

            /*----------------------------------------------------------------*/

            if ($user && $user->level >= 10) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 9)
                    ->first();

                if (!$existingBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 9,
                    ]);
                }
            }

            /*------------------------------------------------------------------*/

            if ($user && $user->level >= 21) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 10)
                    ->first();

                if (!$existingBadge) {
                    DB::table('users_badges')->insert([
                        'user_id' => $user->id,
                        'badge_id' => 10,
                    ]);
                }
            }

            /*-----------------------------------------------------------------*/

            if ($user) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 11)
                    ->first();

                if (!$existingBadge) {
                    $likesCount = DB::table('likes')
                        ->join('posts', 'likes.post_id', '=', 'posts.id')
                        ->where('posts.author', $user->id)
                        ->count();

                    if ($likesCount >= 10) {
                        DB::table('users_badges')->insert([
                            'user_id' => $user->id,
                            'badge_id' => 11,
                        ]);
                    }
                }
            }

            /*-----------------------------------------------------------------*/

            if ($user) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 12)
                    ->first();

                if (!$existingBadge) {
                    $postsCount = DB::table('posts')
                        ->where('author', $user->id)
                        ->count();

                    if ($postsCount >= 5) {
                        DB::table('users_badges')->insert([
                            'user_id' => $user->id,
                            'badge_id' => 12,
                        ]);
                    }
                }
            }

            /*----------------------------------------------------------------*/

            if ($user) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 13)
                    ->first();

                if (!$existingBadge) {
                    $reportsCount = DB::table('rapports')
                        ->where('user_id', $user->id)
                        ->count();

                    if ($reportsCount >= 5) {
                        DB::table('users_badges')->insert([
                            'user_id' => $user->id,
                            'badge_id' => 13,
                        ]);
                    }
                }
            }
        }
    }
}
