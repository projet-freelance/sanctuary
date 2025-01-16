<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $quotes = [
            ['author' => 'Saint Augustin', 'quote' => 'Aime et fais ce que tu veux.'],
            ['author' => 'Saint François d\'Assise', 'quote' => 'Commence par faire le nécessaire, puis fais ce qui est possible et soudain tu réaliseras l\'impossible.'],
            ['author' => 'Saint Jean-Paul II', 'quote' => 'N\'ayez pas peur.'],
            ['author' => 'Sainte Thérèse de Lisieux', 'quote' => 'Je veux passer mon ciel à faire du bien sur la terre.'],
        ];

        foreach ($quotes as $quote) {
            Quote::create($quote);
        }
    }
}
