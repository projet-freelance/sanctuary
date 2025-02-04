<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paydunya\Checkout\CheckoutInvoice;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Services\PaydunyaService; // Assurez-vous d'importer votre service PayDunya

class PaymentController extends Controller
{
    protected $paydunyaService;

    public function __construct(PaydunyaService $paydunyaService)
    {
        $this->paydunyaService = $paydunyaService;
    }

    public function pay(Request $request, Event $event)
    {
        // Valider la quantité de tickets
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);
    
        // Vérifier si le nombre de tickets demandés est disponible
        $quantity = $request->quantity;
    
        if ($event->available_seats < $quantity) {
            return back()->withErrors(['msg' => 'Not enough seats available.']);
        }
    
        $totalAmount = $event->ticket_price * $quantity;
    
        // Créer la facture via le service PayDunya
        $invoiceUrl = $this->paydunyaService->createInvoice(
            $totalAmount,
            "Ticket for {$event->name}",
            route('payment.cancel'),
            route('payment.success', [
                'event_id' => $event->id,
                'quantity' => $quantity
            ])
        );
    
        if ($invoiceUrl) {
            return redirect($invoiceUrl); // Redirige l'utilisateur vers l'URL de paiement
        } else {
            return back()->withErrors(['msg' => 'Payment initiation failed']);
        }
    }

    public function success(Request $request)
    {
        $event = Event::find($request->event_id);
        $quantity = $request->quantity;
    
        if (!$event || $event->available_seats < $quantity) {
            return redirect()->route('payment.cancel')->withErrors(['msg' => 'Not enough seats available or invalid event']);
        }
    
        // Confirmer le paiement avec le token PayDunya
        $token = $request->get('token'); // Assurez-vous que ce token est retourné par PayDunya
        if (!$this->paydunyaService->confirmPayment($token)) {
            return redirect()->route('payment.cancel')->withErrors(['msg' => 'Payment confirmation failed']);
        }
    
        DB::beginTransaction();
        try {
            // Mettre à jour le nombre de places disponibles après l'achat
            $event->available_seats -= $quantity;
            $event->save();
    
            // Enregistrer le ticket
            $ticket = new Ticket();
            $ticket->event_id = $event->id;
            $ticket->user_id = auth()->user()->id;
            $ticket->ticket_code = uniqid();
            $ticket->quantity = $quantity;
            $ticket->save();
    
            DB::commit();
    
            return redirect()->route('tickets.show', $ticket)->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('payment.cancel')->withErrors(['msg' => 'Failed to save ticket']);
        }
    }

    public function cancel()
    {
        return redirect()->route('events.index')->withErrors(['msg' => 'Payment cancelled']);
    }
}
