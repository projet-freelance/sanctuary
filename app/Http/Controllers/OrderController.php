<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\PaydunyaService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $paydunya;

    public function __construct(PaydunyaService $paydunya)
    {
        $this->paydunya = $paydunya;
    }

    // Méthode pour afficher toutes les catégories et leurs produits
   public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category', null);

        if ($selectedCategory) {
            $products = Product::where('category', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('categories', 'products', 'selectedCategory'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    // Méthode pour afficher le formulaire de paiement pour une commande
    public function showPaymentForm(Order $order)
    {
        // Retourner la vue avec la commande
        return view('payments.create', compact('order'));
    }

    // Méthode pour afficher le formulaire de création d'une commande
    public function create(Product $product)
    {
        // Retourner la vue pour créer une commande avec le produit
        return view('orders.create', compact('product'));
    }

    // Fonction pour enregistrer une commande
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);
        $description = "Commande du produit : " . $product->name . " (50% à l'avance)";
        $halfPrice = $product->price * 0.5;
        $cancelUrl = route('products.show', ['id' => $product->id]);
        $returnUrl = route('orders.confirm', ['id' => $product->id]);

        $invoiceUrl = $this->paydunya->createInvoice($halfPrice, $description, $cancelUrl, $returnUrl);

        if ($invoiceUrl) {
            return redirect($invoiceUrl);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Une erreur s\'est produite lors de la création de la facture PayDunya.']);
        }
    }

    public function confirm(Request $request, $id)
    {
        $paymentToken = $request->input('token');

        if ($this->paydunya->confirmPayment($paymentToken)) {
            // Enregistrez l'information de paiement ou faites une autre action nécessaire
            return redirect()->route('products.show', ['id' => $id])->with('success', 'Paiement réussi pour le premier 50%!');
        } else {
            return redirect()->route('products.show', ['id' => $id])->withErrors(['msg' => 'Le paiement a échoué.']);
        }
    }
}
