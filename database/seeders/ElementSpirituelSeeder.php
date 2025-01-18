<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementSpirituelSeeder extends Seeder
{
    public function run()
    {
        $elements = [
            'sins' => [
                'Paresse', 'Gourmandise', 'Orgueil', 'Luxure', 'Avarice', 'Colère', 'Envie'
            ],
            'virtues' => [
                'Humilité', 'Charité', 'Chasteté', 'Générosité', 'Tempérance', 'Patience', 'Diligence'
            ],
            'gifts' => [
                'Sagesse', 'Intelligence', 'Conseil', 'Force', 'Science', 'Piété', 'Crainte de Dieu'
            ],
            'fruits' => [
                'Amour', 'Joie', 'Paix', 'Patience', 'Bonté', 'Bienveillance', 'Fidélité', 'Douceur', 'Maîtrise de soi'
            ],
        ];

        // Insérer les données dans la table 'element_spirituels'
        foreach ($elements as $category => $values) {
            foreach ($values as $value) {
                DB::table('element_spirituels')->insert([
                    'category' => $category, // Ajoutez une colonne 'category' pour savoir si c'est un péché, une vertu, un don, ou un fruit
                    'name' => $value
                ]);
            }
        }
    }
}
