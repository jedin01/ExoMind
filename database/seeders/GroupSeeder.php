<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'id' => 1,
                'vc_nome' => 'Gestão de modelos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'vc_nome' => 'Outros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'vc_nome' => 'Usuários e Autenticação',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}