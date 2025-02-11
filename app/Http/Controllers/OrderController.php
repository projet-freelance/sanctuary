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
    public function index()
    {
        // Charger les catégories avec leurs produits associés
        $categories = Category::with('products')->get();
        
        // Retourner la vue avec les catégories
        return view('products.index', compact('categories'));
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
        $product = Product::findOrFail($id);
        $user = auth()->user(); // Récupérer l'utilisateur connecté

        // Vérifier si la commande existe déjà (évite les doublons)
        $existingOrder = Order::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('status', 'pending')
            ->first();

        if (!$existingOrder) {
            // Créer une nouvelle commande après paiement validé
            $order = new Order();
            $order->user_id = $user->id;
            $order->product_id = $product->id;
            $order->total_price = $product->price;
            $order->paid_amount = $product->price * 0.5; // 50% payé à l'avance
            $order->status = 'partially_paid';
            $order->save();
        } else {
            // Mise à jour du statut de la commande existante
            $existingOrder->paid_amount += $product->price * 0.5;
            $existingOrder->status = 'partially_paid';
            $existingOrder->save();
        }

        return redirect()->route('products.show', ['id' => $id])
            ->with('success', 'Paiement réussi ! La commande a été enregistrée.');
    } else {
        return redirect()->route('products.show', ['id' => $id])
            ->withErrors(['msg' => 'Le paiement a échoué.']);
    }
}

}
