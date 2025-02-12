<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Services\PaydunyaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    protected PaydunyaService $paydunyaService;

    public function __construct(PaydunyaService $paydunyaService)
    {
        $this->paydunyaService = $paydunyaService;
    }

    /**
     * Initialise le paiement avec PayDunya.
     */
    public function pay(Request $request, Event $event)
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login')->withErrors(['msg' => 'Vous devez être connecté pour acheter un ticket.']);
            }

            // Verrouiller l'événement pour éviter les conflits
            $event = Event::lockForUpdate()->findOrFail($event->id);
            
            if ($event->available_seats < 1) {
                throw ValidationException::withMessages([
                    'msg' => "Désolé, il n'y a plus de places disponibles."
                ]);
            }

            $totalAmount = $event->ticket_price;

            // Stocker les données de la transaction en session
            $request->session()->put('payment_data', [
                'event_id' => $event->id,
                'amount' => $totalAmount,
                'initiated_at' => now(),
            ]);

            // Génération des URL de succès et d'annulation
            $cancelUrl = route('payment.cancel');
            $successUrl = route('payment.success');

            // Création de la facture PayDunya
            $invoiceUrl = $this->paydunyaService->createInvoice(
                amount: $totalAmount,
                description: "Billet pour {$event->name}",
                cancelUrl: $cancelUrl,
                returnUrl: $successUrl // Correction : ici, c'est bien `returnUrl`
            );

            if (!$invoiceUrl) {
                throw new \Exception('Échec de l\'initialisation du paiement');
            }

            return redirect()->away($invoiceUrl);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            report($e);
            return back()->withErrors([
                'msg' => 'Une erreur est survenue lors de l\'initialisation du paiement. Veuillez réessayer.'
            ])->withInput();
        }
    }

    /**
     * Vérifie et valide le paiement après succès.
     */
    public function success(Request $request)
{
    if (!$request->session()->has('payment_data')) {
        return redirect()->route('events.index')->withErrors(['msg' => 'Session de paiement expirée']);
    }

    $paymentData = $request->session()->get('payment_data');

    DB::beginTransaction();
    try {
        $event = Event::lockForUpdate()->findOrFail($paymentData['event_id']);

        if ($event->available_seats < 1) {
            throw new \Exception('Places insuffisantes');
        }

        if (!$this->paydunyaService->confirmPayment($request->get('token'))) {
            throw new \Exception('Échec de la confirmation du paiement');
        }

        if ($event->ticket_price !== $paymentData['amount']) {
            throw new \Exception('Montant du paiement incorrect');
        }

        $event->available_seats -= 1;
        $event->save();

        $ticketCode = strtoupper(Str::random(10));

        $ticket = Ticket::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'ticket_code' => $ticketCode,
        ]);

        // Générer le QR Code
        $ticket->generateQrCode();

        DB::commit();
        $request->session()->forget('payment_data');

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Paiement réussi ! Votre billet a été réservé.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('payment.cancel')->withErrors(['msg' => 'Transaction échouée : ' . $e->getMessage()]);
    }
}
 

    /**
     * Annulation du paiement.
     */
    public function cancel(Request $request)
    {
        $request->session()->forget('payment_data');

        return redirect()->route('events.index')
            ->withErrors(['msg' => 'Le paiement a été annulé']);
    }
}
