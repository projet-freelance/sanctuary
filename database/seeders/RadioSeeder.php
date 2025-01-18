<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Radio; // Import du modèle Radio

class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Radio::create([
            'name' => 'Radio Espérance',
            'logo' => 'radio_espe.png', // Chemin du logo
            'url' => 'https://radio-esperance.fr',
        ]);
    
        Radio::create([
            'name' => 'Radio Vie Meilleure',
            'logo' => 'radio-vie-meilleure-logo.png', // Chemin du logo
            'url' => 'https://radioviemeilleure.com',
        ]);
    
        Radio::create([
            'name' => 'Parole de Vie Radio',
            'logo' => 'parol_delavie.png', // Chemin du logo
            'url' => 'https://paroledevie.org',
        ]);
    
        Radio::create([
            'name' => 'Radio Réveil',
            'logo' => 'radio_veil.png', // Chemin du logo
            'url' => 'https://radioreveil.ch',
        ]);
    
        Radio::create([
            'name' => 'Hope Radio',
            'logo' => 'hop_radios.png', // Chemin du logo
            'url' => 'https://hoperadio.fr',
        ]);
    }
}
