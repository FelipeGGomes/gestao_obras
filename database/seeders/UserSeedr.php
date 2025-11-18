<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeedr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cria um usuário "Admin" fixo
        User::create([
            'name' => 'Admin User',
            'cpf' => '00011122233', // CPF fixo
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),    // Senha forte
            'role' => 'admin', // Definindo o papel como 'admin'
        ]);

        // 2. Cria 50 usuários adicionais usando o Factory
        User::factory()->count(50)->create();
    }
}
