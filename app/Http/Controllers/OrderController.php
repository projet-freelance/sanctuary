<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Méthode pour afficher toutes les catégories et leurs produits
    public function index() {
        // Charger les catégories avec leurs produits associés
        $categories = Category::with('products')->get();
        
        // Retourner la vue avec les catégories
        return view('products.index', compact('categories'));
    }

    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    // Méthode pour afficher le formulaire de paiement pour une commande
    public function showPaymentForm(Order $order) {
        // Retourner la vue avec la commande
        return view('payments.create', compact('order'));
    }

    // Méthode pour afficher le formulaire de création d'une commande
    public function create(Product $product) {
        // Retourner la vue pour créer une commande avec le produit
        return view('orders.create', compact('product'));
    }

    // Fonction pour enregistrer une commande
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'product_id' => 'required|exists:products,id', // Vérifie que le produit existe
        ]);

        // Récupérer le produit à partir de l'ID passé dans la requête
        $product = Product::findOrFail($request->product_id);

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Créer la commande
        $order = Order::create([
            'user_id' => $user->id, // L'ID de l'utilisateur
            'product_id' => $product->id, // L'ID du produit
            'total_price' => $product->price, // Le prix total du produit
            'paid_amount' => $product->price * 0.5, // Montant payé (50% du prix du produit)
            'status' => 'partially_paid', // Statut de la commande
        ]);

        // Créer un paiement pour la commande
        Payment::create([
            'order_id' => $order->id, // L'ID de la commande
            'amount' => $product->price * 0.5, // Montant payé
            'status' => 'completed', // Statut du paiement
        ]);

        // Retourner à la page précédente avec un message de succès
        return back()->with('success', 'Commande passée avec succès !');
    }
}
