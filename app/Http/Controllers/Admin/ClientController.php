<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = User::where('is_admin', false)
            ->withCount('commandes')
            ->withSum('commandes', 'total')
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->q . '%')
                        ->orWhere('email', 'like', '%' . $request->q . '%');
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.clients.index', compact('clients'));
    }
}
