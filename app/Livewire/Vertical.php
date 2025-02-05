<?php

namespace App\Livewire;

use Livewire\Component;

class Vertical extends Component
{
    public $ads = [
        [
            'type' => 'image',
            'content' => 'images/public.jpg',
            'title' => 'Promo 1',
            'link' => '#'
        ],
        [
            'type' => 'text',
            'content' => 'Découvrez nos nouveaux articles spirituels !',
            'title' => 'Offre spéciale',
            'link' => '#'
        ],
        [
            'type' => 'video',
            'content' => 'https://exemple.com/video.mp4',
            'title' => 'Vidéo promo',
            'link' => '#'
        ]
    ];

    public $currentIndex = 0;

    public function nextAd()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->ads);
    }
    public function render()
    {
        return view('livewire.vertical');
    }
}
