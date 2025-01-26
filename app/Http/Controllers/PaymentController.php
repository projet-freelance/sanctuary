<?php

namespace App\Http\Controllers;

use App\Services\PayduyaService;
use Illuminate\Http\Request;

class PaymentController extends Controller 
{
    private $payduyaService;

    public function __construct(PayduyaService $payduyaService) 
    {
        $this->payduyaService = $payduyaService;
    }

    public function initPayment(Request $request) 
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000'
        ]);

        $paymentUrl = $this->payduyaService->createInvoice(
            $request->user(), 
            $validated['amount']
        );

        if ($paymentUrl) {
            return redirect($paymentUrl);
        }

        return back()->with('error', 'Échec de la création du paiement');
    }

    public function handleSuccess(Request $request) 
    {
        $token = $request->input('token');

        if ($this->payduyaService->verifyPayment($token)) {
            return redirect()->route('user.consultation')
                ->with('success', 'Paiement confirmé');
        }

        return redirect()->route('payment.error')
            ->with('error', 'Problème de vérification de paiement');
    }

    public function handleCancel() 
    {
        return redirect()->route('home')
            ->with('error', 'Paiement annulé');
    }
}