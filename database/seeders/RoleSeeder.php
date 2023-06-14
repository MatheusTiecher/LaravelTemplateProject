<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'Admin',
            'description' => 'Acesso total ao sistema'
        ]);

        Role::firstOrCreate([
            'name' => 'Usuário',
            'description' => 'Acesso ao site como usuário'
        ]);

        echo "Cargos criados com sucesso!\n";
    }
}
