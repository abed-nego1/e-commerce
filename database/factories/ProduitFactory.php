<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=fake()->word();
        return [
            'nom' => $name,
            'slug'=>Str::slug($name.'-'.fake()->unique()->numberBetween(1, 1000)),
            'description' => fake()->paragraph(),
            'prix' => fake()->randomFloat(2, 1, 100),
            'stock' => fake()->numberBetween(0, 100),
            'actif' => fake()->boolean(),
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/600/400',
            'categorie_id' => Categorie::factory(),
        ];
    }
}
