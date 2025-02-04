<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BibleService;

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
        return response()->json($verses);
    }
}
