<?php

namespace App\Http\Controllers;

use App\Services\BibleService;

class DashboardController extends Controller
{
    protected $bibleService;

    public function __construct(BibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    public function index()
    {
        // Exemple de verset que vous souhaitez afficher
        $verse = $this->bibleService->getVerse('John', 3, 16); 

        // Récupérer les informations du verset
        $verseText = $verse['text']; // Le texte du verset
        $verseReference = $verse['reference']; // La référence du verset

        return view('dashboardclient', [
            'verseText' => $verseText,
            'verseReference' => $verseReference,
        ]);
    }
}
