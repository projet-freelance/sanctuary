<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BibleVideo;

class BibleVideoSeeder extends Seeder
{
    public function run()
    {
        BibleVideo::create([
            'title' => 'L\'Histoire de la Création',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'L\'histoire de la création du monde selon la Genèse.',
        ]);
        
        BibleVideo::create([
            'title' => 'L\'Exode d\'Israël',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'L\'exode d\'Israël sous la conduite de Moïse.',
        ]);
        
        BibleVideo::create([
            'title' => 'La Vie de Jésus-Christ - Partie 1',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'La naissance et les premiers miracles de Jésus-Christ.',
        ]);

        BibleVideo::create([
            'title' => 'La Vie de Jésus-Christ - Partie 2',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'Les enseignements et la passion de Jésus-Christ.',
        ]);

        BibleVideo::create([
            'title' => 'L\'Arche de Noé',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'L\'histoire de l\'arche de Noé et du déluge.',
        ]);

        BibleVideo::create([
            'title' => 'David et Goliath',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'Le courage de David face à Goliath.',
        ]);

        BibleVideo::create([
            'title' => 'Le Jugement de Salomon',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'Le célèbre jugement du roi Salomon.',
        ]);

        BibleVideo::create([
            'title' => 'La Tour de Babel',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'L\'histoire de la tour de Babel et la confusion des langues.',
        ]);

        BibleVideo::create([
            'title' => 'Les Dix Plaies d\'Egypte',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'Les dix plaies que Dieu inflige à l\'Egypte.',
        ]);

        BibleVideo::create([
            'title' => 'L\'Ascension de Jésus-Christ',
            'url' => 'https://www.youtube.com/results?search_query=histoire+de+la+bible',
            'description' => 'L\'ascension de Jésus-Christ vers les cieux.',
        ]);
    }
}
