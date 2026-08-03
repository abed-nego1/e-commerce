<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::firstOrCreate(
    ['email' => 'admin@shop.com'], // Condition de recherche
    [
        'name'     => 'Admin',
        'password' => 'password123',
        'is_admin'     => true,
    ]
);
        User::factory(5)->create();
        Categorie::factory(3)->create();
        $produits = Produit::factory(20)->create();
        Commande::factory(10)->create()->each(
            function ($commande) use ($produits) {
                $produits = Produit::inRandomOrder(20)->take(rand(1, 5))->get();
                $pivotData = [];
                $total = 0;
                foreach ($produits as $produit) {
                    $pivotData[$produit->id] = ['quantite' => rand(1, 20), 'prix_unitaire' => $produit->prix];
                    $total += $pivotData[$produit->id]['quantite'] * $pivotData[$produit->id]['prix_unitaire'];
                }
                $commande->produits()->attach($pivotData);
                $commande->total = $total;
                $commande->save();
            }
        );
    }
}
