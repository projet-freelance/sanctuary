<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ElementSpirituel;
use App\Models\Exercice;
use Illuminate\Support\Facades\Schema;

class Counter extends Component
{
    public $elementTire = null;
    public $type = null;
    public $exercice = null;

    public function tirer($type)
    {
        // Vérifier si la table existe avant d'effectuer une requête
        if (!Schema::hasTable('element_spirituels')) {
            $this->elementTire = "Erreur : La table 'element_spirituels' n'existe pas.";
            return;
        }

        // Vérifier que le type est valide
        if (!in_array($type, [
            ElementSpirituel::TYPE_PECHE,
            ElementSpirituel::TYPE_VERTU,
            ElementSpirituel::TYPE_DON,
            ElementSpirituel::TYPE_FRUIT
        ])) {
            $this->elementTire = "Erreur : Type invalide.";
            return;
        }

        // Tirer un élément spirituel aléatoire pour le type donné
        $this->elementTire = ElementSpirituel::tirerElement($type);
        $this->type = $type;

        // Si aucun élément n'est trouvé, mettre $elementTire à null
        if (!$this->elementTire) {
            $this->elementTire = null;
            return;
        }

        // Vérifier si un exercice existe pour cet élément, sinon en créer un
        $this->exercice = $this->elementTire->exercices()->first();
        if (!$this->exercice) {
            // Créer un exercice si aucun exercice n'existe
            $this->exercice = Exercice::create([
                'element_spirituel_id' => $this->elementTire->id,
                'titre' => 'Méditation sur ' . $this->elementTire->nom,
                'contenu' => 'Prenez 10 minutes pour réfléchir sur : ' . $this->elementTire->nom,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
