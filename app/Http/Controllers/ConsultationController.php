<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Services\PaydunyaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ConsultationController extends Controller
{
    protected $paydunyaService;

    public function __construct(PaydunyaService $paydunyaService)
    {
        $this->paydunyaService = $paydunyaService;
    }

    /**
     * Afficher toutes les consultations de l'utilisateur connecté.
     */
    public function index()
    {
        $consultations = Consultation::where('user_id', Auth::id())
            ->orderBy('scheduled_at')
            ->get();

        return view('consultations.index', compact('consultations'));
    }

    /**
     * Afficher le formulaire de création d'une consultation.
     */
    public function create()
    {
        return view('consultations.create');
    }

    /**
     * Afficher les détails d'une consultation avec l'historique des paiements.
     */
    public function show($id)
    {
        // Récupérer la consultation avec son historique de paiements
        $consultation = Consultation::with('paiements')->findOrFail($id);
    
        // Vérifier si l'utilisateur connecté est le propriétaire de la consultation
        if ($consultation->user_id !== Auth::id()) {
            abort(403, 'Accès interdit.');
        }
    
        // Retourner la vue avec la consultation et son historique de paiements
        return view('consultations.show', compact('consultation'));
    }

    /**
     * Enregistrer une nouvelle consultation et initier le paiement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            // Trouver le prochain créneau disponible après le paiement
            $scheduledAt = $this->getNextAvailableSlot(now()); // Appel avec `now()`
    
            // Enregistrer la consultation avec la date et l'heure automatiquement attribuées
            $consultation = Consultation::create([
                'user_id' => Auth::id(),
                'type' => $request->type,
                'scheduled_at' => $scheduledAt,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);
            
            // Créer une facture PayDunya
            $amount = 500.00; // Montant fixe pour l'exemple
            $description = "Paiement pour consultation";
            $cancelUrl = route('payment.cancel');
            $returnUrl = route('payment.success');

            $invoiceUrl = $this->paydunyaService->createInvoice($amount, $description, $cancelUrl, $returnUrl);

            if ($invoiceUrl) {
                DB::commit();
                return redirect($invoiceUrl); // Rediriger vers l'URL de paiement
            } else {
                DB::rollBack();
                Log::error('Erreur lors de la création de la facture PayDunya.');
                return back()->with('error', 'Une erreur s\'est produite lors de la création de la facture.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la consultation : ' . $e->getMessage());
            return back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    /**
     * Gérer la réponse de PayDunya en cas de succès.
     */
    public function paymentSuccess(Request $request)
    {
        $token = $request->query('token');

        DB::beginTransaction();
        try {
            if ($this->paydunyaService->confirmPayment($token)) {
                // Enregistrer le paiement
                $this->recordPayment(
                    Auth::id(),
                    null, // Consultation ID peut être récupéré si nécessaire
                    100.00,
                    $token,
                    'successful'
                );

                // Mettre à jour le statut de la consultation et programmer automatiquement un créneau horaire
                $consultation = Consultation::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                if ($consultation) {
                    // Trouver le prochain créneau horaire disponible
                    $scheduledAt = $this->getNextAvailableSlot(now()); // Appel avec `now()`
                    $consultation->update([
                        'scheduled_at' => $scheduledAt,
                        'status' => 'scheduled',
                    ]);
                }

                DB::commit();
                return redirect()->route('consultations.index')->with('success', 'Paiement réussi et consultation programmée.');
            } else {
                DB::rollBack();
                Log::error('Paiement non confirmé : ' . $this->paydunyaService->getLastError());
                return redirect()->route('consultations.index')->with('error', 'Paiement échoué.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la confirmation du paiement : ' . $e->getMessage());
            return redirect()->route('consultations.index')->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    /**
     * Gérer la réponse de PayDunya en cas d'annulation.
     */
    public function paymentCancel()
    {
        return redirect()->route('consultations.index')->with('error', 'Paiement annulé.');
    }

    /**
     * Enregistrer un paiement.
     */
    protected function recordPayment($userId, $consultationId, $amount, $transactionId, $status = 'pending')
    {
        DB::table('payments')->insert([
            'user_id' => $userId,
            'consultation_id' => $consultationId,
            'amount' => $amount,
            'transaction_id' => $transactionId,
            'status' => $status,
            'payment_method' => 'paydunya',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Trouver le prochain créneau disponible.
     */
    private function getNextAvailableSlot($requestedDate)
    {
        $currentDate = Carbon::parse($requestedDate);
        $startHour = 20; // Heure de début des consultations
        $endHour = 24; // Heure de fin des consultations
        $maxConsultationsPerDay = 10; // Nombre maximal de consultations par jour

        while (true) {
            if ($currentDate->isWeekday()) {
                // Vérifier combien de consultations sont déjà planifiées pour cette journée
                $dailyCount = Consultation::whereDate('scheduled_at', $currentDate->toDateString())->count();

                if ($dailyCount < $maxConsultationsPerDay) {
                    $slotTime = $startHour + $dailyCount;
                    if ($slotTime < $endHour) {
                        return $currentDate->setTime($slotTime, 0);
                    }
                }
            }
            $currentDate->addDay();
        }
    }
}
