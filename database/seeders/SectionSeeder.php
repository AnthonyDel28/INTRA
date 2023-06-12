<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $sections = [
            [
                'name' => 'Développement',
            ],
            [
                'name' => 'Problèmes et erreurs',
            ],
            [
                'name' => 'Projets et réalisations',
            ],
            [
                'name' => 'Astuces et conseils',
            ],
            [
                'name' => 'Ressources',
            ],
        ];

        DB::table('sections')->insert($sections);
    }
}
