<?php

namespace App\Livewire;

use Livewire\Component;

class OraisonPicker extends Component
{
    public $selectedOraisons = [];

    public function mount()
    {
        $this->piocherOraisons();
    }

    public function piocherOraisons()
    {
        $oraisons = [
            "Cœur Sacré de Jésus, j'ai confiance en Vous !",
            "Jésus est Seigneur",
            "Père, enflamme-moi du feu de Ton Esprit !",
            "Mon Seigneur et mon Dieu !",
            "Père, Augmente en moi la foi !",
            "Seigneur Jésus, que j’entende avec tes oreilles !",
            "Père augmente en moi l'espérance !",
            "Père augmente en moi la charité !",
            "Ô Jésus, je repose en toi",
            "Mère du Bel Amour, aide tes enfants !",
            "Seigneur !, Tu sais tout, tu sais que je t'aime !",
            "Seigneur, que veux-tu que je fasse ?",
            "Sur ta parole, je jetterai les filets !",
            "Doux Cœur de Jésus, sois mon Amour !",
            "Doux Cœur de Marie, sois mon salut !",
            "Que veux-tu de moi, Jésus ?",
            "Seigneur Jésus, que je touche avec tes mains !",
            "Je suis né pour Toi !",
            "Seigneur, que je voie !",
            "Seigneur, que cela soit !",
            "A Dieu toute la gloire !",
            "Nous voulons que le Christ règne !",
            "Tout concourt au bien !",
            "Que cela soit fait, que cela s'accomplisse !",
            "Doux cœur de Marie, prépare un chemin sûr !",
            "Cœur de Jésus, donne-moi la paix !",
            "Abba, entre tes mains j’abandonne mon esprit",
            "Si Dieu est pour nous, qui sera contre nous ?",
            "Dieu Tout-puissant, humilie mes ennemis !",
            "Sainte Marie, que le temps de l'épreuve soit court !",
            "Seigneur Jésus, que je voie avec tes yeux !",
            "Mon Christ, Jésus de mon âme !",
            "Seigneur Jésus, que je parle avec ta bouche !",
            "Seigneur Jésus, que ta parole me guide !",
            "C'est ta face, Seigneur, que je cherche !",
            "Oui, je veux voir à quoi ressemble le Seigneur, face à face",
            "O père, donne un cœur pur !",
            "O père, aide moi à pardonner",
            "O cœur de Marie apprends-moi à aimer !",
            "Mon Dieu, ayez pitié de moi!",
            "Mon Dieu, je Vous aime de tout mon cœur.",
            "Mon Dieu et mon tout!",
            "Mon Dieu, je me donne tout à Vous!",
            "Que Votre volonté soit faite!",
            "Jésus, Marie!",
            "Mon Jésus, miséricorde!",
            "O très doux Jésus, ne soyez point mon Juge, mais mon Sauveur!",
            "La Croix du Seigneur est mon refuge !",
            "Doux Cœur de Jésus, faites que je vous aime de plus en plus.",
            "Notre-Dame de Lourdes, priez pour nous.",
            "Notre-Dame de Pitié, Mère de tous les chrétiens, priez pour nous.",
            "Ô Marie, ma Mère, gardez-moi aujourd'hui de tout péché mortel.",
            "Vierge Marie, priez Jésus pour moi !",
            "Ô Marie, mère de la miséricorde, priez pour nous !",
            "Jésus, j’ai confiance en toi !",
            "Mon Dieu, mon unique bien !",
            "Que Votre volonté soit faite sur la terre !",
            "Tout est pour le mieux !",
            "Montrez que Vous êtes notre Mère!",
            "Vive Jésus dans nos cœurs! À jamais!",
            "Mon Dieu, Vous savez que je ne veux que Vous!",
            "Mon Jésus, miséricorde!",
            "O Dieu, que je fasse quelque chose digne de Vous.",
            "Ayez pitié de moi, pécheur!",
            "Loués soient Jésus et Marie !",
            "Cachez-moi dans vos plaies, ô Jésus !",
            "Ô Jésus, j’ai soif de toi !",
            "Jésus-Christ!",
            "Mon Jésus, pardon et miséricorde par Vos saintes Plaies!",
            "J’offre les saintes plaies de Jésus-Christ pour guérir celles de nos âmes !",
            "Prends-moi, Seigneur, dans la richesse divine de ton silence !",
            "Fais taire en moi ce qui n’est pas toi !",
            "Jésus-Christ impose silence à mes désirs !",
            "Jésus-Christ impose silence à mes caprices !",
            "Jésus-Christ impose silence à la violence de mes passions.",
            "Jésus-Christ couvre par ton silence mes plaintes."
        ];

        // Tirer 5 oraisons aléatoires
        $this->selectedOraisons = collect($oraisons)->random(2);
    }

    public function render()
    {
        return view('livewire.oraison-picker');
    }
}
