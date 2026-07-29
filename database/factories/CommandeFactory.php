<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total' => fake()->randomFloat(2, 10),
            'statut' => fake()->randomElement(['en cours', 'expédiée', 'livrée']),
            'adresse_livraison' => fake()->address(),
        ];
    }
}
