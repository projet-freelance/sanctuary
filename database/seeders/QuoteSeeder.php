<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $quotes = [
            // Nouvelles citations
            ['author' => 'Saint Bernard de Clairvaux', 'quote' => 'Qu’est-ce qu’est l’avarice ? Vivre dans la pauvreté par peur de la pauvreté.'],
            ['author' => 'Saint Bernard de Clairvaux', 'quote' => 'L’impunité provoque la témérité et cette dernière ouvre la voie à chaque excès.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Il ne peut point y avoir de joie dans la vie sans la joie du travail.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Rien n’est dans l’intelligence qui n’ait été d’abord dans les sens.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Aimer, c’est vouloir du bien pour quelqu’un.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Pour la relaxation de l’esprit, il est requis que l’on utilise, de temps à autre, des boutades et des plaisanteries.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Les véritables amis se réjouissent et s’attristent des mêmes choses.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Le bien peut exister sans le mal alors que le mal ne peut exister sans le bien.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'En Dieu se trouvent les perfections de toutes les choses.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'Une loi méchante n’est pas une loi.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'La béatitude parfaite est naturelle uniquement pour Dieu, pour lequel être et être bienheureux sont la même chose. Pour toutes les créatures, par contre, être bienheureuses ne relève pas de leur nature, mais est leur but ultime.'],
            ['author' => 'Saint Thomas d’Aquin', 'quote' => 'L’amour de soi est la cause de tous les péchés.'],
            ['author' => 'Saint François de Sales', 'quote' => 'Fleuris là où tu es planté'],
            ['author' => 'Sainte Elisabeth de la Trinité', 'quote' => 'Chaque minute nous est donnée pour nous enraciner en Dieu'],
            ['author' => 'Saint Antoine de Padoue', 'quote' => 'Les actes en disent plus que les mots. Que vos paroles enseignent, que vos actes parlent.'],
            ['author' => 'Saint Padre Pio', 'quote' => 'Mon passé, ô Seigneur, à ta Miséricorde, mon présent à ton Amour, mon avenir à ta Providence.'],
            ['author' => 'Saint Jean Paul II', 'quote' => 'L\'homme n\'apprend vraiment qu\'en reconnaissant ses propres erreurs.'],
            ['author' => 'Sainte Catherine de Sienne', 'quote' => 'La vie est un pont, traverse-le, mais n\'y fixe pas ta demeure'],
            ['author' => 'Sainte Claire de Castelbajac', 'quote' => 'Je m\'aperçois maintenant combien tout, dans la vie, doit être tourné vers Dieu, et que, si on le pense vraiment, cela ne demande même pas d\'effort, tellement c\'est naturel.” (...) “Tu as pour vocation le bonheur !'],
            ['author' => 'Sainte Elisabeth de la Trinité', 'quote' => 'Crois toujours à l’amour et chante toujours merci'],
            ['author' => 'Sainte Mère Térésa', 'quote' => 'On ne fait pas de grandes choses, mais seulement des petites avec un amour immense.'],
            ['author' => 'Saint Augustin', 'quote' => 'Aime, et fais ce que tu veux. Si tu te tais, tais-toi par amour ; si tu parles, parle par amour ; si tu corriges, corrige par amour ; si tu pardonnes, pardonne par amour. Aie au fond du cœur la racine de l’amour, de cette racine ne peut rien sortir que de bon.'],
            ['author' => 'Saint Basile de Césarée', 'quote' => 'Dans la nature même de l’homme se trouve inséré un germe qui contient en lui cette aptitude à aimer'],
            ['author' => 'Saint François de Sales', 'quote' => 'Le monde est né de l\'amour, il est soutenu par l\'amour, il va vers l\'amour et il entre dans l\'amour.'],
            ['author' => 'Sainte Thérèse de Lisieux', 'quote' => 'Aimer, c’est tout donner et se donner soi-même'],
        ];

        foreach ($quotes as $quote) {
            Quote::firstOrCreate(
                ['quote' => $quote['quote']],
                ['author' => $quote['author']]
            );
        }
    }
}
