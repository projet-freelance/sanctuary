<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Services\PaydunyaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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
        Log::info('Début de la méthode success');
    
        if (!$request->session()->has('payment_data')) {
            Log::error('Session de paiement expirée ou manquante');
            return redirect()->route('events.index')->withErrors(['msg' => 'Session de paiement expirée']);
        }
    
        $paymentData = $request->session()->get('payment_data');
        Log::info('Données de la session de paiement', $paymentData);
    
        DB::beginTransaction();
        try {
            Log::info('Recherche de l\'événement', ['event_id' => $paymentData['event_id']]);
            $event = Event::lockForUpdate()->findOrFail($paymentData['event_id']);
    
            if ($event->available_seats < 1) {
                Log::error('Places insuffisantes pour l\'événement', ['event_id' => $event->id]);
                throw new \Exception('Places insuffisantes');
            }
    
            Log::info('Confirmation du paiement avec PayDunya', ['token' => $request->get('token')]);
            if (!$this->paydunyaService->confirmPayment($request->get('token'))) {
                Log::error('Échec de la confirmation du paiement');
                throw new \Exception('Échec de la confirmation du paiement');
            }
    
            if ($event->ticket_price !== $paymentData['amount']) {
                Log::error('Montant du paiement incorrect', [
                    'montant_événement' => $event->ticket_price,
                    'montant_paiement' => $paymentData['amount'],
                ]);
                throw new \Exception('Montant du paiement incorrect');
            }
    
            $event->available_seats -= 1;
            $event->save();
            Log::info('Places disponibles mises à jour', ['places_restantes' => $event->available_seats]);
    
            $ticketCode = strtoupper(Str::random(10));
            Log::info('Création du ticket', ['ticket_code' => $ticketCode]);
    
            $ticket = Ticket::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'ticket_code' => $ticketCode,
            ]);
            Log::info('Ticket créé avec succès', ['ticket_id' => $ticket->id]);
    
            // Générer le QR Code (si applicable)
            $ticket->generateQrCode();
            Log::info('QR Code généré pour le ticket', ['ticket_id' => $ticket->id]);
    
            DB::commit();
            $request->session()->forget('payment_data');
            Log::info('Redirection vers la page du ticket', ['ticket_id' => $ticket->id]);
    
            return redirect()->route('tickets.show', $ticket)
                ->with('success', 'Paiement réussi ! Votre billet a été réservé.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la confirmation du paiement', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
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
