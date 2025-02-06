<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ElementSpirituel;
use App\Models\Exercice;
use Carbon\Carbon;

class ElementSpirituelSeeder extends Seeder
{
    public function run()
    {
        $elements = [
            'peche' => [
                ['nom' => 'Orgueil', 'description' => 'Excès de confiance en soi.'],
                ['nom' => 'Colère', 'description' => 'Emportement incontrôlé.'],
                ['nom' => 'Luxure', 'description' => 'Désir excessif pour le plaisir sexuel.'],
                ['nom' => 'Envie', 'description' => 'Désir de posséder ce que les autres ont.'],
                ['nom' => 'Gourmandise', 'description' => 'Manger de manière excessive.'],
                ['nom' => 'Avarice', 'description' => 'Souci excessif de l’argent.'],
                ['nom' => 'Paresse', 'description' => 'Manque de volonté et d’effort.'],
                ['nom' => 'Mensonge', 'description' => 'Dissimuler la vérité.'],
                ['nom' => 'Jalousie', 'description' => 'Ressentiment envers ceux qui réussissent.'],
                ['nom' => 'Pride', 'description' => 'Se considérer comme supérieur aux autres.'],
            ],
            'vertu' => [
                ['nom' => 'Patience', 'description' => 'Capacité à supporter les difficultés sans se fâcher.'],
                ['nom' => 'Charité', 'description' => 'Donner aux autres sans attendre de retour.'],
                ['nom' => 'Humilité', 'description' => 'Reconnaître sa petitesse et dépendance.'],
                ['nom' => 'Sagesse', 'description' => 'Capacité de discerner le bien du mal.'],
                ['nom' => 'Loyauté', 'description' => 'Être fidèle à ses engagements.'],
                ['nom' => 'Courage', 'description' => 'Faire face à la peur avec bravoure.'],
                ['nom' => 'Honnêteté', 'description' => 'Dire la vérité et agir avec intégrité.'],
                ['nom' => 'Douceur', 'description' => 'Comportement calme et aimable.'],
                ['nom' => 'Générosité', 'description' => 'Partager ce que l’on possède avec les autres.'],
                ['nom' => 'Espérance', 'description' => 'Avoir une attitude positive et croire en un avenir meilleur.'],
            ],
            'don' => [
                ['nom' => 'Guérison', 'description' => 'Capacité de guérir les maladies physiques ou spirituelles.'],
                ['nom' => 'Prophétie', 'description' => 'Capacité de prédire l’avenir avec clarté.'],
                ['nom' => 'Discernement', 'description' => 'Capacité à juger correctement des situations.'],
                ['nom' => 'Foi', 'description' => 'Confiance absolue en Dieu et dans ses promesses.'],
                ['nom' => 'Miracles', 'description' => 'Réalisation d’actes surnaturels.'],
                ['nom' => 'Langues', 'description' => 'Capacité de parler des langues étrangères non apprises.'],
                ['nom' => 'Intercession', 'description' => 'Prier pour les autres avec une foi ardente.'],
                ['nom' => 'Enseignement', 'description' => 'Capacité à expliquer la vérité de manière claire.'],
                ['nom' => 'Leadership', 'description' => 'Inspiration des autres à suivre une voie positive.'],
                ['nom' => 'Service', 'description' => 'Aider les autres sans attendre de récompense.'],
            ],
            'fruit' => [
                ['nom' => 'Amour', 'description' => 'L’amour pour Dieu et pour les autres.'],
                ['nom' => 'Joie', 'description' => 'Un bonheur profond et durable.'],
                ['nom' => 'Paix', 'description' => 'Calme intérieur, absence de conflits.'],
                ['nom' => 'Longanimité', 'description' => 'Capacité à supporter les souffrances sans réagir.'],
                ['nom' => 'Bonté', 'description' => 'Être bienveillant envers les autres.'],
                ['nom' => 'Bonté', 'description' => 'Compassion et aide pour les autres.'],
                ['nom' => 'Fidélité', 'description' => 'Être fidèle aux engagements pris.'],
                ['nom' => 'Maîtrise de soi', 'description' => 'Contrôle de ses émotions et de ses actes.'],
                ['nom' => 'Gentillesse', 'description' => 'Être doux, sympathique et agréable.'],
                ['nom' => 'Modestie', 'description' => 'Humilité dans les actions et les pensées.'],
            ]
        ];

        // Insertion des éléments et exercices associés
        foreach ($elements as $type => $data) {
            foreach ($data as $elementData) {
                $element = ElementSpirituel::create([
                    'nom' => $elementData['nom'],
                    'type' => $type,
                    'description' => $elementData['description'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Créer un exercice associé à l'élément
                Exercice::create([
                    'element_spirituel_id' => $element->id,
                    'titre' => 'Méditation sur ' . $element->nom,
                    'contenu' => 'Prenez 10 minutes pour réfléchir sur : ' . $element->nom,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
