<?php

namespace App\Services;

use Paydunya\Setup;
use Paydunya\Checkout\Store;
use Paydunya\Checkout\CheckoutInvoice;
use Exception;
use Illuminate\Support\Facades\Log;

class PaydunyaService
{
    protected $invoice;

    public function __construct()
    {
        // Configurer PayDunya
        Setup::setMasterKey(env('PAYDUNYA_MASTER_KEY'));
        Setup::setPublicKey(env('PAYDUNYA_PUBLIC_KEY'));
        Setup::setPrivateKey(env('PAYDUNYA_PRIVATE_KEY'));
        Setup::setToken(env('PAYDUNYA_TOKEN'));
        Setup::setMode(env('PAYDUNYA_MODE', 'test')); // 'test' ou 'live'

        // Configurer le store
        Store::setName(env('APP_NAME', 'Mon Application'));
        Store::setTagline(env('APP_TAGLINE', 'Paiements sécurisés'));
        Store::setPhoneNumber(env('STORE_PHONE'));
        Store::setPostalAddress(env('STORE_ADDRESS'));
        Store::setWebsiteUrl(env('APP_URL'));
        Store::setLogoUrl(env('STORE_LOGO_URL'));

        $this->invoice = new CheckoutInvoice();
    }

    /**
     * Créer une facture PayDunya.
     */
    public function createInvoice($amount, $description, $cancelUrl, $returnUrl)
    {
        try {
            $this->invoice->addItem($description, 1, $amount, $amount);
            $this->invoice->setTotalAmount($amount);
            $this->invoice->setDescription($description);
            $this->invoice->setCancelUrl($cancelUrl);
            $this->invoice->setReturnUrl($returnUrl);

            if ($this->invoice->create()) {
                return $this->invoice->getInvoiceUrl();
            } else {
                Log::error('Erreur PayDunya : ' . $this->invoice->response_text);
                return null;
            }
        } catch (Exception $e) {
            Log::error('Erreur lors de la création de la facture PayDunya : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Confirmer un paiement PayDunya.
     */
    public function confirmPayment($token)
    {
        try {
            if ($this->invoice->confirm($token)) {
                return $this->invoice->getStatus() === 'completed';
            } else {
                Log::error('Erreur PayDunya : ' . $this->invoice->response_text);
                return false;
            }
        } catch (Exception $e) {
            Log::error('Erreur lors de la confirmation du paiement PayDunya : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtenir la dernière erreur PayDunya.
     */
    public function getLastError()
    {
        return $this->invoice->response_text;
    }
}