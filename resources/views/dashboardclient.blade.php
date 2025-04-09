@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-violet-50 to-blue-100 flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow space-y-8">
        {{-- Message de Bienvenue avec animation --}}
        <div class="w-full animate-fade-in">
    <div class="bg-white rounded-3xl shadow-lg border border-opacity-20 border-blue-300 overflow-hidden 
              transform transition-all duration-500 hover:shadow-xl backdrop-blur-sm bg-opacity-80">
        <div class="p-6">
            <!-- Modification ici : Ajout d'un texte par défaut qui sera remplacé par JS -->
            <h1 class="text-3xl font-bold text-blue-800 mb-2" id="greeting">
                Bienvenue, {{ Auth::user()->name }} dans votre espace spirituel
            </h1>
            <p class="text-xl italic text-violet-600 font-semibold mb-4" id="proverb">
                "Remets ton sort à l'Éternel, et il te soutiendra." - Psaumes 55:22
            </p>
            <p class="text-gray-600" id="blessing">Que la paix du Christ guide votre journée.</p>
        </div>
    </div>
</div>

        {{-- Versets du Jour avec animation --}}
        <div class="w-full animate-slide-up delay-100">
            <div class="bg-white rounded-3xl shadow-lg border border-opacity-20 border-blue-300 overflow-hidden 
                      transform transition-all duration-500 hover:scale-[1.01] hover:shadow-xl backdrop-blur-sm bg-opacity-80">
                <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100">
                    <h2 class="text-2xl font-extrabold text-blue-800 mb-4 flex items-center">
                        <x-heroicon-o-book-open class="h-7 w-7 mr-3 text-blue-600 animate-bounce-slow"/>
                        Versets du Jour
                    </h2>
                    <div class="bg-white rounded-xl p-4 shadow-inner border border-blue-100 animate-fade-in delay-200">
                        <livewire:dailyverses />
                    </div>
                </div>
            </div>
        </div>

        {{-- Exercice Spirituel avec animation --}}
        <div class="w-full animate-slide-up delay-200">
            <div class="bg-white rounded-3xl shadow-lg border border-opacity-20 border-violet-300 overflow-hidden 
                      transform transition-all duration-500 hover:scale-[1.01] hover:shadow-xl backdrop-blur-sm bg-opacity-80">
                <div class="p-6 bg-gradient-to-r from-violet-50 to-violet-100">
                    <h2 class="text-2xl font-extrabold text-violet-800 mb-4 flex items-center">
                        <x-heroicon-o-sparkles class="h-7 w-7 mr-3 text-violet-600 animate-pulse"/>
                        Exercice Spirituel
                    </h2>
                    <div class="bg-white rounded-xl p-4 shadow-inner border border-violet-100 animate-fade-in delay-300">
                        <livewire:counter />
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation vers les autres sections --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in delay-300">
            <a href="{{ route('oraison-spirituel') }}" class="block group transform transition-all duration-300 hover:-translate-y-1">
                <div class="bg-white rounded-2xl shadow-md border border-opacity-20 border-blue-300 overflow-hidden 
                          transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl group-hover:bg-blue-50 backdrop-blur-sm">
                    <div class="p-5 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-violet-100 rounded-lg mr-3 group-hover:bg-violet-200 transition-colors">
                                <x-heroicon-o-heart class="h-6 w-6 text-violet-600 group-hover:scale-110 transition-transform"/>
                            </div>
                            <h3 class="text-xl font-bold text-violet-800">Oraison Spirituelle</h3>
                        </div>
                        <x-heroicon-o-arrow-right class="h-6 w-6 text-blue-500 transform group-hover:translate-x-2 transition-transform"/>
                    </div>
                </div>
            </a>
            <a href="{{ route('pick-ange') }}" class="block group transform transition-all duration-300 hover:-translate-y-1">
                <div class="bg-white rounded-2xl shadow-md border border-opacity-20 border-blue-300 overflow-hidden 
                          transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl group-hover:bg-blue-50 backdrop-blur-sm">
                    <div class="p-5 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3 group-hover:bg-blue-200 transition-colors">
                                <x-heroicon-o-light-bulb class="h-6 w-6 text-blue-500 group-hover:scale-110 transition-transform"/>
                            </div>
                            <h3 class="text-xl font-bold text-blue-800">Pick-Ange</h3>
                        </div>
                        <x-heroicon-o-arrow-right class="h-6 w-6 text-blue-500 transform group-hover:translate-x-2 transition-transform"/>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Debug: Vérifier que le script s'exécute
        console.log('Script de bienvenue exécuté');
        
        const hour = new Date().getHours();
        const userName = "{{ Auth::user()->name }}"; // Récupération Laravel
        
        // Debug: Afficher les valeurs
        console.log('Heure actuelle:', hour);
        console.log('Nom utilisateur:', userName);
        
        // Déterminer le message en fonction de l'heure
        let timeGreeting, proverb;
        
        if (hour >= 5 && hour < 12) {
            timeGreeting = 'bonjour et bénédictions matinales';
            proverb = '"Ce jour est consacré à l\'Éternel; ne vous affligez pas, car la joie de l\'Éternel est votre force." - Néhémie 8:10';
        } else if (hour >= 12 && hour < 18) {
            timeGreeting = 'bel après-midi dans la grâce du Seigneur';
            proverb = '"J\'ai été jeune, j\'ai vieilli; et je n\'ai pas vu le juste abandonné." - Psaumes 37:25';
        } else if (hour >= 18 && hour < 22) {
            timeGreeting = 'douce soirée en Christ';
            proverb = '"L\'Éternel est mon berger: je ne manquerai de rien." - Psaumes 23:1';
        } else {
            timeGreeting = 'que votre nuit soit paisible et bénie';
            proverb = '"Je me couche et je m\'endors en paix, car toi seul, ô Éternel, tu me fais reposer en sécurité." - Psaumes 4:8';
        }
        
        // Mise à jour des éléments DOM
        const greetingEl = document.getElementById('greeting');
        const proverbEl = document.getElementById('proverb');
        const blessingEl = document.getElementById('blessing');
        
        if (greetingEl) {
            greetingEl.textContent = `Bienvenue, ${userName}, ${timeGreeting} dans votre espace spirituel`;
            greetingEl.classList.add('animate-text-focus-in');
        }
        
        if (proverbEl) {
            proverbEl.textContent = proverb;
            proverbEl.classList.add('animate-text-wave');
        }
        
        if (blessingEl) {
            blessingEl.classList.add('animate-pulse-slow');
        }
        
    } catch (error) {
        console.error('Erreur dans le script de bienvenue:', error);
    }
});
</script>
@endpush

@push('styles')
<style>
    /* Animation personnalisée */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes pulseSlow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    @keyframes bounceSlow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    @keyframes textWave {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-2px); }
        75% { transform: translateX(2px); }
    }
    
    @keyframes textFocusIn {
        0% { filter: blur(12px); opacity: 0; }
        100% { filter: blur(0); opacity: 1; }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }
    
    .animate-pulse-slow {
        animation: pulseSlow 3s ease-in-out infinite;
    }
    
    .animate-bounce-slow {
        animation: bounceSlow 3s ease-in-out infinite;
    }
    
    .animate-text-wave {
        animation: textWave 5s ease-in-out infinite;
    }
    
    .animate-text-focus-in {
        animation: textFocusIn 0.8s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
    }
    
    .delay-300 {
        animation-delay: 0.3s;
    }
    
    .transform {
        transition: all 0.3s ease-in-out;
    }
    
    body {
        font-family: 'Nunito', sans-serif;
        background-attachment: fixed;
    }
    
    /* Effet de profondeur pour les cartes */
    .shadow-inner {
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    /* Effet de flou pour le fond */
    .backdrop-blur-sm {
        backdrop-filter: blur(6px);
    }
</style>
@endpush