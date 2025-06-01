<?php

namespace App\Http\Controllers;

use App\Models\commande;
use App\Models\produit;
use App\Models\produitcommande;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommandeController extends Controller
{

    public function commande()
    {
        $commande = commande::all();
        return view('admindashboard.usersorders', compact('commande'));
    }

    public function checkout(Request $request)
    {
        try {

            $produits = $request->input('produits');


            if (empty($produits)) {
                return response()->json(['message' => 'panier vide'], 400);
            }

            $pricetotal = 0;
            foreach ($produits as $produit) {
                $pricetotal += $produit['price'] * $produit['quantite'];
            }

            $commande = commande::create([
                'status' => 'encoure',
                'date' => now(),
                'pricetotal' => $pricetotal,
                'user_id' => auth()->id() ?? 1,
                'payment_id' => null,
            ]);

            foreach ($produits as $produit) {
                produitcommande::create([
                    'produit_id' => $produit['id'],
                    'commande_id' => $commande->id,
                    'quantite' => $produit['quantite'],
                    'price' => $produit['price'],
                ]);
            }

            return response()->json([
                'message' => 'commande saved',
                'commande_id' => $commande->id
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur : ' . $e->getMessage());

            return response()->json([
                'message' => 'Erreur trmnt commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // public function annulercommande($id)
    // {
    //     $commande = commande::find($id);
    //     $commande->annulercommande();
    //     return redirect()->route('commande');
    // }


    // public function update(Request $request)
    // {
    //     // echo $request->commande_id;
    //     // die();
    //     $commande = commande::find($request->commande_id);
    //     // dd($request->commande_id);
    //     // dd(DB::table('commandes')->find($request->commande_id));
    //     $commande->update([
    //         'status' =>$request->status,
    //     ]);
    //     return redirect()->route('commande')->with('success', 'commande updated successfully.');
    // }

    /**
     * Admin commandes Listing for userscommandes.blade.php
     */
    public function adminorders(Request $request)
    {
        // Filters
        $query = \App\Models\Commande::with(['user']);
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('price_min')) {
            $query->where('prixtotal', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('prixtotal', '<=', $request->price_max);
        }
        $commandes = $query->withCount('produitCommandes')->orderByDesc('created_at')->paginate(10);

        // Stats for dashboard cards
        $now = now();
        $lastMonth = $now->copy()->subMonth();
        $stats = [
            'total' => \App\Models\Commande::count(),
            'completed' => \App\Models\Commande::where('status', 'completed')->count(),
            'pending' => \App\Models\Commande::where('status', 'pending')->count(),
            'cancelled' => \App\Models\Commande::where('status', 'cancelled')->count(),
            'total_change' => $this->getStatChange(''),
            'completed_change' => $this->getStatChange('completed'),
            'pending_change' => $this->getStatChange('pending'),
            'cancelled_change' => $this->getStatChange('cancelled'),
        ];
        $users = \App\Models\User::orderBy('firstname')->get();
        return view('admindashboard.usersorders', compact('commandes', 'stats', 'users'));
    }

    /**
     * Helper for stat change
     */
    private function getStatChange($status = '')
    {
        $now = now();
        $lastMonth = $now->copy()->subMonth();
        $current = \App\Models\Commande::when($status, fn($q) => $q->where('status', $status))->whereBetween('created_at', [$lastMonth, $now])->count();
        $previous = \App\Models\Commande::when($status, fn($q) => $q->where('status', $status))->whereBetween('created_at', [$lastMonth->copy()->subMonth(), $lastMonth])->count();
        if ($previous == 0) return $current > 0 ? 100 : 0;
        return round((($current - $previous) / $previous) * 100);
    }

    /**
     * View a single commande
     */
    public function view($id)
    {
        $commande = \App\Models\Commande::with(['user', 'produitCommandes.produit'])->findOrFail($id);
        return view('admindashboard.usersorders', compact('commande'));
    }

    /**
     * Edit a single commande
     */
    public function edit($id)
    {
        $commande = \App\Models\Commande::with(['user', 'produitCommandes.produit'])->findOrFail($id);
        return view('admindashboard.usersorders', compact('commande'));
    }

    /**
     * Delete a single commande
     */
    public function destroy($id)
    {
        $commande = \App\Models\Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('admindashboard.usersorders')->with('success', 'commande deleted successfully.');
    }
}
