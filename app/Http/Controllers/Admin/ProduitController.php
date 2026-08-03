<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit; // Ou Product selon ton modèle
use App\Models\Categorie; // Ou Category selon ton modèle
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Liste tous les produits
     */
    public function index()
    {
        // On récupère les produits avec leur catégorie associée, 10 par page
        $produits = Produit::with('categorie')->latest()->paginate(10);

        return view('admin.products.index', compact('produits'));
    }

    /**
     * Formulaire de création d'un produit
     */
    public function create()
    {
        $categories = Categorie::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Enregistre un nouveau produit
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom'          => 'required|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'actif'        => 'nullable|boolean',
        ]);

        // Génération automatique du slug à partir du nom
        $validatedData['slug'] = Str::slug($request->nom) . '-' . time();
        $validatedData['actif'] = $request->has('actif');

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $validatedData['image'] = $path;
        }

        Produit::create($validatedData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit créé avec succès !');
    }

    /**
     * Formulaire de modification d'un produit
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();

        return view('admin.products.edit', compact('produit', 'categories'));
    }

    /**
     * Met à jour un produit existant
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $validatedData = $request->validate([
            'nom'          => 'required|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'actif'        => 'nullable|boolean',
        ]);

        // Mise à jour du slug si le nom a changé
        if ($request->nom !== $produit->nom) {
            $validatedData['slug'] = Str::slug($request->nom) . '-' . time();
        }

        $validatedData['actif'] = $request->has('actif');

        // Gestion de la nouvelle image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image du stockage si elle existe
            if ($produit->image && Storage::disk('public')->exists($produit->image)) {
                Storage::disk('public')->delete($produit->image);
            }
            $path = $request->file('image')->store('produits', 'public');
            $validatedData['image'] = $path;
        }

        $produit->update($validatedData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit mis à jour avec succès !');
    }

    /**
     * Supprime un produit
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);

        // Grâce à softDeletes dans ta migration, ceci fera une suppression douce
        $produit->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit supprimé avec succès !');
    }
}
