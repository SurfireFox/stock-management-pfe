<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        $categorie = Categorie::all();
        $produit = produit::all();

        return view('home', compact('categorie', 'produit'));
    }
}
