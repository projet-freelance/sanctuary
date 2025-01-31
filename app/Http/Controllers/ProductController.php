<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Afficher tous les produits
    public function index()
    {   
        
        $products = Product::all();  // Récupère tous les produits
        
        return view('products.index', compact('products'));  // Passe la variable à la vue
    }

    // Afficher un produit spécifique
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

}
