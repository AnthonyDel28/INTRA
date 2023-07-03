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

        if($user){
            $userID = $user->id;

            $experience = DB::table('users')
                ->where('id', $userID)
                ->value('experience');

            if ($experience > 200) {
                $level = 21;
            } elseif ($experience > 180) {
                $level = 20;
            } elseif ($experience > 164) {
                $level = 19;
            } elseif ($experience > 150) {
                $level = 18;
            } elseif ($experience > 137) {
                $level = 17;
            } elseif ($experience > 125) {
                $level = 16;
            } elseif ($experience > 112) {
                $level = 15;
            } elseif ($experience > 100) {
                $level = 14;
            } elseif ($experience > 89) {
                $level = 13;
            } elseif ($experience > 79) {
                $level = 12;
            } elseif ($experience > 69) {
                $level = 11;
            } elseif ($experience > 60) {
                $level = 10;
            } elseif ($experience > 43) {
                $level = 9;
            } elseif ($experience > 41) {
                $level = 8;
            } elseif ($experience > 35) {
                $level = 7;
            } elseif ($experience > 28) {
                $level = 6;
            } elseif ($experience > 22) {
                $level = 5;
            } elseif ($experience > 17) {
                $level = 4;
            } elseif ($experience > 12) {
                $level = 3;
            } elseif ($experience > 8) {
                $level = 2;
            } else {
                $level = 1;
            }

            DB::table('users')
                ->where('id', $userID)
                ->update(['level' => $level]);
        }




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
            if ($user->role_id === 1) {
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
            } else {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 1)
                    ->first();

                if ($existingBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 1)
                        ->delete();
                }
            }
            /*---------------------------------------------------------------*/


            $scores = DB::table('scores')
                ->orderBy('score', 'desc')
                ->pluck('user_id');

            $userID = $user->id;


            if ($scores->first() === $userID) {
                $badge2 = DB::table('users_badges')
                    ->where('user_id', $userID)
                    ->where('badge_id', 2)
                    ->first();

                if (!$badge2) {
                    DB::table('users_badges')->insert([
                        'user_id' => $userID,
                        'badge_id' => 2
                    ]);
                }
            } else {
                $badge2 = DB::table('users_badges')
                    ->where('user_id', $userID)
                    ->where('badge_id', 2)
                    ->first();

                if ($badge2) {
                    DB::table('users_badges')
                        ->where('user_id', $userID)
                        ->where('badge_id', 2)
                        ->delete();
                }
            }


            /*--------------------------------------------------------------*/

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
            } else {
                $commentBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 3)
                    ->first();

                if ($commentBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 3)
                        ->delete();
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
            } else {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 5)
                    ->first();

                if ($friendshipBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 5)
                        ->delete();
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
            } else {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 6)
                    ->first();

                if ($friendshipBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 6)
                        ->delete();
                }
            }

            /*--------------------------------------------------------------*/


            $scores = DB::table('scores')
                ->orderBy('score', 'desc')
                ->pluck('user_id')
                ->take(5);

            $userID = $user->id;

            if ($scores->contains($userID)) {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $userID)
                    ->where('badge_id', 7)
                    ->first();

                if (!$friendshipBadge) {

                    DB::table('users_badges')->insert([
                        'user_id' => $userID,
                        'badge_id' => 7
                    ]);
                }
            } else {
                $friendshipBadge = DB::table('users_badges')
                    ->where('user_id', $userID)
                    ->where('badge_id', 7)
                    ->first();

                if ($friendshipBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $userID)
                        ->where('badge_id', 7)
                        ->delete();
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
            } else {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 8)
                    ->first();

                if ($existingBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 8)
                        ->delete();
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
            } else {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 9)
                    ->first();

                if ($existingBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 9)
                        ->delete();
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
            } else {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 10)
                    ->first();

                if ($existingBadge) {
                    DB::table('users_badges')
                        ->where('user_id', $user->id)
                        ->where('badge_id', 10)
                        ->delete();
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
                } else {
                    $likesCount = DB::table('likes')
                        ->join('posts', 'likes.post_id', '=', 'posts.id')
                        ->where('posts.author', $user->id)
                        ->count();

                    if ($likesCount < 10) {
                        DB::table('users_badges')
                            ->where('user_id', $user->id)
                            ->where('badge_id', 11)
                            ->delete();
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
                } else {
                    $postsCount = DB::table('posts')
                        ->where('author', $user->id)
                        ->count();

                    if ($postsCount < 5) {
                        DB::table('users_badges')
                            ->where('user_id', $user->id)
                            ->where('badge_id', 12)
                            ->delete();
                    }
                }
            }

            /*------------------------------------------------------------*/

            if ($user) {
                $existingBadge = DB::table('users_badges')
                    ->where('user_id', $user->id)
                    ->where('badge_id', 13)
                    ->first();

                $reportsCount = DB::table('rapports')
                    ->where('user_id', $user->id)
                    ->count();

                if ($reportsCount >= 5) {
                    if (!$existingBadge) {
                        DB::table('users_badges')->insert([
                            'user_id' => $user->id,
                            'badge_id' => 13,
                        ]);
                    }
                } else {
                    if ($existingBadge) {
                        DB::table('users_badges')
                            ->where('user_id', $user->id)
                            ->where('badge_id', 13)
                            ->delete();
                    }
                }
            }

        }
    }
}
