<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\BibleService;

class DailyVerses extends Component
{
    public $verses = [];
    public $currentVerseIndex = 0;
    public $isComplete = false;

    protected $bibleService;

    public function boot(BibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    public function mount()
    {
        $this->verses = $this->bibleService->getDailyVerses();
    }

    public function nextVerse()
    {
        if ($this->currentVerseIndex < count($this->verses) - 1) {
            $this->currentVerseIndex++;
        } else {
            $this->isComplete = true;
        }
    }

    public function resetVerses()
    {
        $this->currentVerseIndex = 0;
        $this->isComplete = false;
    }


    public function render()
    {
        return view('livewire.dailyverses');
    }
}