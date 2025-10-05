<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ProvinciaMunicipiosSeeder;
use VacinasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GroupSeeder::class);
        $this->call(ModuleSeeder::class);

        Role::create([
            'id'=>1,
            'vc_nome'=>"Administrador"
        ]);
        
        User::create([
            'name'=>"Admin",
            'email'=>"admin@example.com",
            'password'=>Hash::make("12345678"),
            'it_id_role'=>"1",
        ]);

    }

}
