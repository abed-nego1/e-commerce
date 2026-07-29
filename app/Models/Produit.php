<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'slug', 'description', 'prix', 'stock', 'actif', 'image', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
