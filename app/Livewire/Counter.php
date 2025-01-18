<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ElementSpirituel;
class Counter extends Component
{
    
        public $sins = [];
        public $virtues = [];
        public $gifts = [];
        public $fruits = [];
    
        public $elementTire = null;
        public $type = null;
    
        // Initialisation des sélections aléatoires
        public function mount()
        {
            $this->drawRandomSelections();
        }
    
        // Fonction pour tirer des éléments aléatoires depuis la configuration
        public function drawRandomSelections()
        {
            $data = config('resources'); // Charger depuis le fichier de configuration
    
            $this->sins = collect($data['sins'])->random(3)->toArray();
            $this->virtues = collect($data['virtues'])->random(3)->toArray();
            $this->gifts = collect($data['gifts'])->random(3)->toArray();
            $this->fruits = collect($data['fruits'])->random(3)->toArray();
        }
    
        // Fonction pour tirer un élément en fonction du type
        public function tirer($type)
        {
            $this->type = $type;
    
            // Récupérer un élément aléatoire selon le type
            $this->elementTire = ElementSpirituel::where('category', $type)
                ->inRandomOrder()
                ->first();
        }
    public function render()
    {
        return view('livewire.counter');
    }
}

