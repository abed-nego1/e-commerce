<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrdersCount = Commande::where('statut', 'en_attente')->count();

        $revenue30Days = Commande::where('statut', 'validee')
            ->where('created_at', '>=', now()->subDays(30))
            ->sum('total');

        $customersCount = User::where('is_admin', false)->count();

        $activeProductsCount = Produit::where('actif', true)->count();

        $recentOrders = Commande::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingOrdersCount',
            'revenue30Days',
            'customersCount',
            'activeProductsCount',
            'recentOrders'
        ));
    }
}
