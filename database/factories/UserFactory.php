<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cpf' => $this->generateCpf(), // Adicionando a chamada para gerar o CPF
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // A senha 'password' hash e deve corresponder ao seu fillable
            'password' => Hash::make('password'), 
            'remember_token' => Str::random(10),
        ];
    }
    
    /**
     * Gera um CPF falso e válido (ou simplesmente no formato). 
     * Dependendo da sua implementação, você pode precisar de uma biblioteca mais robusta.
     * Este é um exemplo simples que gera 11 dígitos.
     *
     * @return string
     */
    protected function generateCpf(): string
    {
        // Exemplo: Simplesmente gera 11 dígitos.
        // Se precisar de validação real de CPF, considere uma biblioteca de terceiros.
        $cpf = str_pad(rand(1, 999999999), 9, '0', STR_PAD_LEFT);
        $cpf .= str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        return $cpf;
    }

    // ... (restante do código, como o método unverified)
}