<?php

namespace App\Livewire;

use Livewire\Component;

class PickAnge extends Component
{
    public $selectedAnge;
    public $description;

    protected $anges = [
        [
            'name' => 'Les séraphins',
            'description' => 'Leur nom signifie chaleur et lumière : ils sont enflammés de l\'amour de Dieu au plus haut degré, leur qualité principale est l\'amour.',
        ],
        [
            'name' => 'Les chérubins',
            'description' => 'Leur nom signifie sagesse et science : ils sont capables de montrer à Dieu ceux qui doutent, et leur vertu est la science.',
        ],
        [
            'name' => 'Les trônes',
            'description' => 'Ils personnifient la justice et l\'autorité de Dieu. Ils exercent la justice divine pour organiser le monde matériel et y inspirer les représentants de l\'ordre.',
        ],
        [
            'name' => 'Les dominations',
            'description' => 'Les esprits plus élevés en dignité qui communiquent aux ordres inférieurs les dons de Dieu.',
        ],
        [
            'name' => 'Les vertus',
            'description' => 'Symbolisent la force et la vigueur durant un projet entrepris.',
        ],
        [
            'name' => 'Les puissances',
            'description' => 'Travaillent essentiellement à maintenir l\'ordre divin et lutter contre les démons.',
        ],
        [
            'name' => 'Les principautés',
            'description' => 'Dirigent et éclairent les anges et archanges. Leur mission consiste à faire régner un certain ordre sur la Terre par leur intervention céleste.',
        ],
        [
            'name' => 'Les archanges',
            'description' => 'Sont les messagers extraordinaires de Dieu auprès des hommes. Ils annoncent de grands événements, et dirigent les anges.',
        ],
        [
            'name' => 'Les anges',
            'description' => 'Ils annoncent des nouvelles. Ce sont des messagers de Dieu, aidant les humains dans leur cheminement spirituel.',
        ],
        [
            'name' => 'Michel',
            'description' => '"Qui est comme Dieu ?" est considéré comme le protecteur du peuple de Dieu et le chef des armées célestes.',
        ],
        [
            'name' => 'Gabriel',
            'description' => '"Dieu est ma force" est connu comme le messager de Dieu, souvent envoyé pour annoncer de grandes nouvelles, comme l\'annonce de la naissance de Jésus à Marie.',
        ],
        [
            'name' => 'Rafaël',
            'description' => '"Dieu guérit" Rafaël est l\'archange de la guérison et est souvent invoqué pour obtenir la guérison physique et spirituelle. Il agit aussi pour le mariage, combat, besoins matériels, voyager en sécurité.',
        ],
        [
            'name' => 'Uriel',
            'description' => '"Flamme de Dieu" est connu comme l\'archange de la sagesse et de l\'illumination.',
        ],
        [
            'name' => 'Barachiel',
            'description' => '"Bénédiction de Dieu" est l\'archange des bénédictions et est souvent invoqué pour obtenir les bénédictions et les grâces de Dieu.',
        ],
        [
            'name' => 'Jéhudiel',
            'description' => '"Louer Dieu" est l\'archange du travail et de la récompense, souvent invoqué pour obtenir de l\'aide dans les efforts et les travaux quotidiens.',
        ],
        [
            'name' => 'Sealtiel',
            'description' => '"Prière de Dieu" est l\'archange de la prière et de l\'adoration, souvent invoqué pour guider les prières et aider à se rapprocher de Dieu.',
        ],
    ];

    public function pickRandomAnge()
    {
        $randomAnge = $this->anges[array_rand($this->anges)];
        $this->selectedAnge = $randomAnge['name'];
        $this->description = $randomAnge['description'];
    }
    public function render()
    {
        return view('livewire.pick-ange');
    }
}
