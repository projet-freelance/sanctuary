<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BibleService;
use Stichoza\GoogleTranslate\GoogleTranslate;

class VerseController extends Controller
{
    protected $bibleService;

    public function __construct(BibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    public function dailyVerses()
    {
        $verses = $this->bibleService->getDailyVerses();
        
        // Traduction des versets en français
        $translator = new GoogleTranslate('fr');
        foreach ($verses as &$verse) {
            $verse['text'] = $translator->translate($verse['text']);
        }

        return response()->json($verses);
    }
}
?>