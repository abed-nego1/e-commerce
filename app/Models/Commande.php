<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'statut', 'adresse_livraison'];

    protected $casts = [
        'adresse_livraison' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produits')
            ->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }
}
