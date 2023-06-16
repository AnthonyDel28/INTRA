<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BadgeSeeder extends Seeder
{
    public function run()
    {

        $badges = [
            [
                'name' => 'Admin',
                'badge' => 'Administrateur',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'admin.png',
                'description' => 'Avoir le rôle Administrateur'
            ],
            [
                'name' => 'Champion',
                'badge' => 'Champion',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'champion.png',
                'description' => 'Être champion d\'un jeu'
            ],
            [
                'name' => 'Commentor',
                'badge' => 'Commentor',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'commentor.png',
                'description' => 'Avoir publié au moins dix commentaires'
            ],
            [
                'name' => 'Contributor',
                'badge' => 'Contributeur',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'contributor.png',
                'description' => 'Avoir contribué au dépot Github'
            ],
            [
                'name' => '5 Amis',
                'badge' => 'Amical',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'friends_5.png',
                'description' => 'Avoir au moins 5 amis'
            ],
            [
                'name' => '10 Amis',
                'badge' => 'Populaire',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'friends_10.png',
                'description' => 'Avoir au moins 10 amis'
            ],
            [
                'name' => 'Gamer',
                'badge' => 'Joueur',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'gamer.png',
                'description' => 'Avoir une place dans les classements de tous nos jeux'
            ],
            [
                'name' => 'Niveau 5',
                'badge' => 'Niveau 5',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'level_5.png',
                'description' => 'Atteindre le niveau 5'
            ],
            [
                'name' => 'Niveau 10',
                'badge' => 'Niveau 10',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'level_10.png',
                'description' => 'Atteindre le niveau 10'
            ],
            [
                'name' => 'Niveau 20',
                'badge' => 'Niveau 20',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'level_20',
                'description' => 'Atteindre le niveau 20'
            ],
            [
                'name' => 'Liked',
                'badge' => 'Apprécié',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'liked.png',
                'description' => 'Avoir au moins 10 likes sur l\'ensemble de ses posts',
            ],
            [
                'name' => 'Publisher',
                'badge' => 'Publieur',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'publisher.png',
                'description' => 'Avoir publié au moins 5 posts'
            ],
            [
                'name' => 'Reporter',
                'badge' => 'Rapporteur',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'reporter.png',
                'description' => 'Avoir publié au moins 5 rapports'
            ],
            [
                'name' => 'Validate',
                'badge' => 'Validé',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'validate.png',
                'description' => 'Compte validé'
            ],
        ];

        DB::table('badges')->insert($badges);
    }
}
