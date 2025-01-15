<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Prayer;

class PrayerSeeder extends Seeder
{
    public function run()
    {
        Prayer::create([
            'user_id' => 1, // ID de l'utilisateur
            'title' => 'Notre Père',
            'message' => 'Notre Père qui es aux cieux, que ton nom soit sanctifié. Que ton règne vienne. Que ta volonté soit faite sur la terre comme au ciel.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de bénédiction',
            'message' => 'Que le Seigneur te bénisse et te garde ! Que le Seigneur fasse briller son visage sur toi et qu’il t’accorde sa grâce ! Que le Seigneur tourne son visage vers toi et qu’il te donne la paix !',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de guérison',
            'message' => 'Seigneur, je viens devant toi en croyant que tu as le pouvoir de guérir toutes les maladies. Je te prie pour ma guérison et celle de mes proches, dans le nom de Jésus.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de protection',
            'message' => 'Seigneur, protège-moi de tout mal et guide mes pas chaque jour. Que ton amour me couvre et que ta paix m’entoure.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de foi',
            'message' => 'Seigneur, je mets ma confiance en toi. Augmente ma foi et donne-moi la force de marcher selon ta volonté.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de paix intérieure',
            'message' => 'Seigneur, accorde-moi ta paix qui surpasse toute intelligence. Que mon cœur soit calme et rempli de ton amour.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière pour la famille',
            'message' => 'Seigneur, bénis ma famille. Protège-la et unis-la dans l’amour et l’harmonie. Fais grandir la foi en nous et guide nos vies.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de gratitude',
            'message' => 'Seigneur, je te rends grâce pour toutes les bénédictions que tu as versées sur ma vie. Merci pour ton amour inconditionnel et pour ta fidélité.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière pour le pardon',
            'message' => 'Seigneur, pardonne-moi mes fautes et aide-moi à pardonner à ceux qui m’ont offensé. Donne-moi un cœur pur et un esprit réconcilié.',
        ]);

        Prayer::create([
            'user_id' => 1, 
            'title' => 'Prière de force et de courage',
            'message' => 'Seigneur, donne-moi la force de surmonter les épreuves. Que ton courage m’inspire et que ta présence me fortifie dans les moments difficiles.',
        ]);
    }
}
