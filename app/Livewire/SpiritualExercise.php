<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class SpiritualExercise extends Component
{
    public $sins = [];
    public $virtues = [];
    public $gifts = [];
    public $fruits = [];

    public function mount()
    {
        $this->drawRandomSelections();
    }

    public function drawRandomSelections()
    {
        $data = config('resources'); // Charger depuis le fichier de configuration

        $this->sins = collect($data['sins'])->random(3)->toArray();
        $this->virtues = collect($data['virtues'])->random(3)->toArray();
        $this->gifts = collect($data['gifts'])->random(3)->toArray();
        $this->fruits = collect($data['fruits'])->random(3)->toArray();
    }

    public function render()
    {
        return view('livewire.spiritual-exercise');
    }
}
