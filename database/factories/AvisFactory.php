<?php

namespace Database\Factories;

use App\Models\Avis;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis>
 */
class AvisFactory extends Factory
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
            'produit_id' => Produit::factory(),
            'note' => fake()->numberBetween(1, 5),
            'commentaire' => fake()->paragraph(),
            'approuve' => fake()->boolean(),
        ];
    }
}
