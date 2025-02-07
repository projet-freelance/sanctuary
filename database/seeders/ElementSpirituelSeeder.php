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
                ['nom' => 'L\'orgueil', 'description' => 'Excès de fierté et d\'estime de soi, au point de se croire supérieur aux autres.'],
                ['nom' => 'L\'avarice', 'description' => 'Le désir excessif de posséder et d\'accumuler des richesses matérielles, souvent au détriment des autres.'],
                ['nom' => 'La luxure', 'description' => 'La recherche immodérée des plaisirs charnels, souvent au détriment de la dignité humaine.'],
                ['nom' => 'L\'envie', 'description' => 'Le ressentiment envers ceux qui possèdent ce que l\'on désire, souvent accompagné de jalousie.'],
                ['nom' => 'La gourmandise', 'description' => 'L\'appétit excessif pour la nourriture et les boissons.'],
                ['nom' => 'La colère', 'description' => 'La perte de contrôle de soi, menant à des actes ou des paroles violentes.'],
                ['nom' => 'La paresse', 'description' => 'Le refus de faire des efforts, tant physiques que spirituels.'],
                ['nom' => 'L\'inconstance', 'description' => 'Manque de constance dans les engagements, particulièrement dans la prière.'],
                ['nom' => 'Impureté du cœur', 'description' => 'Avoir des pensées négatives et des désirs impurs.'],
                ['nom' => 'Le mensonge', 'description' => 'Mentir intentionnellement et de manière grave.'],
                ['nom' => 'La calomnie', 'description' => 'Propager des fausses rumeurs pour nuire à la réputation d’autrui.'],
                ['nom' => 'La masturbation', 'description' => 'Se livrer à des actes sexuels solitaires.'],
                ['nom' => 'Le vol', 'description' => 'Prendre les biens d’autrui de manière injuste.'],
                ['nom' => 'L\'adultère', 'description' => 'Avoir des relations sexuelles avec une personne mariée à quelqu\'un d\'autre.'],
                ['nom' => 'La profanation du jour du Seigneur', 'description' => 'Ne pas honorer le jour du Seigneur par l’absence d’activités religieuses.'],
                ['nom' => 'La fornication', 'description' => 'Avoir des relations sexuelles en dehors du mariage.'],
                ['nom' => 'La pornographie', 'description' => 'Consommer ou produire du contenu pornographique.'],
                ['nom' => 'L\'avortement', 'description' => 'Mettre fin délibérément à une grossesse.'],
                ['nom' => 'L\'idolâtrie', 'description' => 'Adorer des idoles ou d\'autres dieux en dehors de Dieu.'],
                ['nom' => 'Le blasphème', 'description' => 'Dire ou faire quelque chose de sacrilège contre Dieu ou les choses saintes.'],
                ['nom' => 'Mentir sur des choses insignifiantes', 'description' => 'Dire des mensonges qui n’ont pas de conséquences graves.'],
                ['nom' => 'Parler mal des autres', 'description' => 'Faire des commentaires négatifs sans intention de nuire gravement.'],
                ['nom' => 'Négliger ses prières', 'description' => 'Omettre de prier régulièrement.'],
                ['nom' => 'Être impatient ou irritable', 'description' => 'Montrer de l’impatience ou de l’irritabilité dans des situations quotidiennes.'],
                ['nom' => 'Ne pas aider les autres', 'description' => 'Refuser d’aider quelqu’un dans le besoin.'],
                ['nom' => 'Avoir des pensées jalouses', 'description' => 'Ressentir de la jalousie envers les autres sans agir sur ces sentiments.'],
                ['nom' => 'Le désespoir du salut', 'description' => 'Croire que Dieu ne peut pas nous pardonner ou nous sauver.'],
                ['nom' => 'La présomption de se sauver sans mérite', 'description' => 'Croire qu’on peut être sauvé sans l’aide de Dieu ou sans efforts personnels.'],
                ['nom' => 'Nier la vérité connue', 'description' => 'Rejeter une vérité évidente que l’on connaît.'],
            ],
            'vertu' => [
                ['nom' => 'Patience', 'description' => 'Capacité à supporter les difficultés sans se fâcher.'],
                ['nom' => 'Charité', 'description' => 'Donner sans attendre de retour.'],
                ['nom' => 'Humilité', 'description' => 'Reconnaître sa petitesse et dépendance vis-à-vis de Dieu.'],
                ['nom' => 'Sagesse', 'description' => 'Capacité de discerner le bien du mal et d’agir en conséquence.'],
                ['nom' => 'Loyauté', 'description' => 'Être fidèle à ses engagements.'],
                ['nom' => 'Courage', 'description' => 'Faire face à la peur avec détermination.'],
                ['nom' => 'Honnêteté', 'description' => 'Dire la vérité et agir avec intégrité.'],
                ['nom' => 'Douceur', 'description' => 'Comportement calme et aimable envers autrui.'],
                ['nom' => 'Générosité', 'description' => 'Partager ce que l’on possède.'],
                ['nom' => 'Espérance', 'description' => 'Croire en un avenir meilleur, confiants en la promesse de Dieu.'],
                ['nom' => 'La foi', 'description' => 'La confiance en Dieu et en ses promesses, même sans preuves tangibles.'],
                ['nom' => 'La prudence', 'description' => 'Faire des choix sages après avoir discerné le bien du mal.'],
                ['nom' => 'La justice', 'description' => 'Respect des droits de chacun et de l’équité dans les relations.'],
                ['nom' => 'La force', 'description' => 'La capacité de surmonter les obstacles avec persévérance.'],
                ['nom' => 'La tempérance', 'description' => 'Maîtriser ses désirs pour éviter les excès.'],
                ['nom' => 'L’humilité', 'description' => 'Reconnaître ses limites et servir les autres sans chercher la reconnaissance.'],
                ['nom' => 'La gratitude', 'description' => 'Exprimer sa reconnaissance pour les bénédictions reçues.'],
                ['nom' => 'La miséricorde', 'description' => 'Être compatissant et prêt à pardonner.'],
                ['nom' => 'La bienveillance', 'description' => 'Rechercher le bien-être des autres avec douceur.'],
                ['nom' => 'La persévérance', 'description' => 'Continuer à œuvrer pour le bien malgré les obstacles.'],
                ['nom' => 'La douceur', 'description' => 'Rester calme et serein même dans les situations de stress.'],
                ['nom' => 'La pureté', 'description' => 'Vivre une vie sans péché, avec un cœur pur.'],
                ['nom' => 'L’obéissance', 'description' => 'Suivre la volonté de Dieu, même lorsqu’elle est difficile à comprendre.'],
                ['nom' => 'La générosité', 'description' => 'Partager de manière désintéressée ce que l’on possède.'],
                ['nom' => 'La sincérité', 'description' => 'Dire la vérité de manière authentique et sans hypocrisie.'],
                ['nom' => 'La modestie', 'description' => 'Vivre simplement sans chercher à attirer l’attention sur soi.'],
                ['nom' => 'La joie', 'description' => 'Le bonheur intérieur provenant de la relation avec Dieu.'],
            ],
            'don' => [
                ['nom' => 'Guérison', 'description' => 'Capacité de guérir les maladies physiques ou spirituelles.'],
                ['nom' => 'Miracles', 'description' => 'Actions extraordinaires manifestant la puissance de Dieu.'],
                ['nom' => 'Prophétie', 'description' => 'Révélation de la volonté de Dieu pour le futur.'],
                ['nom' => 'Discernement des esprits', 'description' => 'Capacité de distinguer les bonnes influences des mauvaises.'],
                ['nom' => 'Langues', 'description' => 'Parler dans des langues inconnues comme signe de la présence du Saint-Esprit.'],
                ['nom' => 'Interprétation des langues', 'description' => 'Interpréter les messages donnés dans des langues inconnues.'],
                ['nom' => 'Foi', 'description' => 'Croire fermement en la capacité de Dieu à agir dans nos vies.'],
                ['nom' => 'Sagesse', 'description' => 'Comprendre les mystères divins et les appliquer.'],
                ['nom' => 'Connaissance', 'description' => 'Compréhension profonde de la vérité divine.'],
                ['nom' => 'Force', 'description' => 'Capacité de surmonter les obstacles spirituels et physiques.'],
            ],
            'fruit' => [
                ['nom' => 'Amour', 'description' => 'L’amour inconditionnel envers Dieu et son prochain.'],
                ['nom' => 'Joie', 'description' => 'Un bonheur intérieur indépendant des circonstances.'],
                ['nom' => 'Paix', 'description' => 'L’harmonie intérieure et extérieure, apportée par Dieu.'],
                ['nom' => 'Patience', 'description' => 'Supporter avec calme les difficultés.'],
                ['nom' => 'Bonté', 'description' => 'Être bienveillant et chercher à aider les autres.'],
                ['nom' => 'Bienveillance', 'description' => 'Avoir une attitude favorable envers les autres.'],
                ['nom' => 'Fidélité', 'description' => 'Être constant et fidèle dans ses engagements envers Dieu et les autres.'],
                ['nom' => 'Douceur', 'description' => 'Agir avec calme et respect.'],
                ['nom' => 'Maîtrise de soi', 'description' => 'Savoir se contrôler et ne pas céder à des impulsions négatives.'],
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
