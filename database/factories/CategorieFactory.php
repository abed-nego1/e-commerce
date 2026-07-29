<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'nom'=>$name,
            'slug'=>Str::slug($name . '-' . fake()->unique()->numberBetween(1, 1000)),
            'image'=>fake()->imageUrl(),

        ];
    }
}
