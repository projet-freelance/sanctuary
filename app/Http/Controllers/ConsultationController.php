<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\PayDunyaService;

class ConsultationController extends Controller
{
    // Afficher toutes les consultations de l'utilisateur connecté
    public function index()
    {
        $consultations = Consultation::where('user_id', Auth::id())
            ->orderBy('scheduled_at')
            ->get();

        return view('consultations.index', compact('consultations'));
    }

    // Page de création d'une nouvelle consultation
    public function create()
    {
        return view('consultations.create');
    }

    // Sauvegarder une consultation et gérer le paiement avec PayDunya
    public function store(Request $request, PayDunyaService $payDunyaService)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $amount = 20.00; // Montant fixe de la consultation

        try {
            // Créer une facture et obtenir l'URL de paiement
            $paymentUrl = $payDunyaService->createInvoice($amount, "Paiement pour consultation personnelle");

            // Enregistrer la consultation avec statut "en attente de paiement"
            $consultation = Consultation::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'queue_position' => Consultation::whereDate('scheduled_at', now())->count() + 1,
                'scheduled_at' => null, // La date sera définie après confirmation du paiement
                'notes' => $request->notes,
            ]);

            Payment::create([
                'user_id' => Auth::id(),
                'consultation_id' => $consultation->id,
                'amount' => $amount,
                'transaction_id' => null, // Défini après confirmation
                'status' => 'pending',
                'payment_method' => 'PayDunya',
            ]);

            // Rediriger vers la page de paiement PayDunya
            return redirect()->to($paymentUrl);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création du paiement : ' . $e->getMessage());
        }
    }

    // Trouver le prochain créneau disponible
    private function getNextAvailableSlot()
    {
        $currentDate = Carbon::now();
        $startHour = 20;
        $endHour = 24;

        while (true) {
            if ($currentDate->isWeekday()) {
                $dailyCount = Consultation::whereDate('scheduled_at', $currentDate->toDateString())->count();

                if ($dailyCount < 10) {
                    $slotTime = $startHour + $dailyCount;
                    if ($slotTime < $endHour) {
                        return $currentDate->setTime($slotTime, 0);
                    }
                }
            }
            $currentDate->addDay();
        }
    }

    // Afficher les détails d'une consultation
    public function show(Consultation $consultation)
    {
        $this->authorize('view', $consultation);

        return view('consultations.show', compact('consultation'));
    }
}
