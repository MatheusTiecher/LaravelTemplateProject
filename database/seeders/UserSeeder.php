<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria o usuário admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin@admin.admin'),
        ]);

        // pega o cargo "admin"
        $role = Role::find(1);
        // Atribui a permissão "admin-admin" ao cargo "admin"
        $role->permissions()->attach(1);
        // Atribui a role "admin" ao usuário
        $admin->roles()->attach($role);
    }
}
