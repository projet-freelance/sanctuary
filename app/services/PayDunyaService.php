<?php

namespace App\Services;

use Paydunya\Setup;
use Paydunya\Checkout\CheckoutInvoice;

class PayDunyaService
{
    public function __construct()
    {
        Setup::setMasterKey(config('services.paydunya.master_key'));
        Setup::setPrivateKey(config('services.paydunya.private_key'));
        Setup::setPublicKey(config('services.paydunya.public_key'));
        Setup::setToken(config('services.paydunya.token'));
        Setup::setMode(config('services.paydunya.mode')); // 'test' ou 'live'

        // Information de l'entreprise
        Setup::setAccountName("Nom de votre entreprise");
        Setup::setLogoUrl("https://exemple.com/logo.png"); // Optionnel
        Setup::setReturnUrl(route('consultations.success')); // URL de retour après paiement
        Setup::setCancelUrl(route('consultations.cancel')); // URL d'annulation
    }

    public function createInvoice($amount, $description)
    {
        $invoice = new CheckoutInvoice();
        $invoice->addItem("Consultation", 1, $amount, $amount, $description);

        if ($invoice->create()) {
            return $invoice->getInvoiceUrl(); // URL à envoyer au client
        } else {
            throw new \Exception($invoice->response_text);
        }
    }
}
