<?php
// Fichier: app/Http/Controllers/OraisonSpirituelController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OraisonSpirituelController extends Controller
{
    /**
     * Affiche la page d'Oraison Spirituel
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('oraison-spirituel');
    }
}