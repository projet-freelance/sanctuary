<?php

namespace App\Services;

use Paydunya\Setup;
use Paydunya\Checkout\Store;
use Paydunya\Checkout\CheckoutInvoice;

class PaydunyaService
{
    protected $invoice;

    public function __construct()
    {
        // Configuration de PayDunya
        Setup::setMasterKey(env('PAYDUNYA_MASTER_KEY'));
        Setup::setPublicKey(env('PAYDUNYA_PUBLIC_KEY'));
        Setup::setPrivateKey(env('PAYDUNYA_PRIVATE_KEY'));
        Setup::setToken(env('PAYDUNYA_TOKEN'));
        Setup::setMode(env('PAYDUNYA_MODE', 'test'));

        // Configuration du store
        Store::setName("Site de Rencontre");
        Store::setTagline("Abonnement aux services premium");
        Store::setPhoneNumber("0584656447");
        Store::setPostalAddress("Dakar, Sénégal");
        Store::setWebsiteUrl(config('app.url'));
        Store::setLogoUrl(asset('images/logo.png'));

        $this->invoice = new CheckoutInvoice();
    }

    /**
     * Créer une facture PayDunya.
     */
    public function createInvoice($amount, $description, $cancelUrl, $returnUrl)
    {
        $this->invoice->addItem("Consultation", 1, $amount, $amount);
        $this->invoice->setTotalAmount($amount);
        $this->invoice->setDescription($description);
        $this->invoice->setCancelUrl($cancelUrl);
        $this->invoice->setReturnUrl($returnUrl);

        if ($this->invoice->create()) {
            return $this->invoice->getInvoiceUrl();
        }

        return null;
    }

    /**
     * Confirmer un paiement PayDunya.
     */
    public function confirmPayment($token)
    {
        return $this->invoice->confirm($token);
    }

    /**
     * Obtenir la dernière erreur PayDunya.
     */
    public function getLastError()
    {
        return $this->invoice->response_text;
    }
}