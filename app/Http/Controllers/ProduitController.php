<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produitdetail', compact('produit'));
    }

    //Client-facing shop view
    public function produit()
    {
        $produit = Produit::all();
        $categories = Categorie::all();
        return view('pages.product', compact('produit', 'categories'));
    }
    public function adminProduit()
    {
        $produit  = Produit::all();
        return view('admindashboard.products', compact('produit'));
    }

    public function create(Request $request)
    {
        Produit::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'photo' => $request['photo'],
            'prix' => $request['prix'],
            'categorie_id' => $request['categorie_id'],
        ]);

        return redirect()->route('createproduit');
    }
    public function delete($id)
    {
        $produit = Produit::find($id);
        $produit->delete();
        return redirect()->route('produit.delete');
    }
    public function update(Request $request)
    {
        $produit = Produit::find($request->produit_id);
        $produit->update([
            'name' => $request->name,
            'description' => $request->description,
            'prix'  => $request->prix,
            'photo'  => $request->photo,
            'categorie_id' => $request->categorie_id,
        ]);
        return redirect()->route('produit.update');
    }
}
