@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br bg-purple-100  flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow">
        {{-- Bouton de retour --}}
        <a href="{{ route('dashboard') }}" class="inline-flex items-center mb-6  hover:text-blue-600 transition-colors duration-300 group">
            <x-heroicon-o-arrow-left class="h-5 w-5 mr-2 transform group-hover:-translate-x-1 transition-transform"/>
            Retour au tableau de bord
        </a>
        
        {{-- En-tête --}}
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 overflow-hidden mb-8 animate-fade-in">
            <div class="p-6 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-white p-3 rounded-full mr-4 shadow-inner border border-violet-200/50">
                        <x-heroicon-o-heart class="h-10 w-10 text-violet-600 animate-pulse-slow"/>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-violet-900 font-serif">Oraison Spirituelle</h1>
                        <p class="text-violet-700 italic">"Approchons-nous avec un cœur sincère, dans la plénitude de la foi" - Hébreux 10:22</p>
                    </div>
                </div>
                <div class="text-right bg-white/80 px-4 py-2 rounded-xl border border-white/30 shadow-sm mt-4 md:mt-0">
                    <span class="block text-sm text-violet-600">Nous sommes le</span>
                    <span class="block text-lg font-semibold text-violet-800" id="current-date">{{ now()->translatedFormat('l d F Y') }}</span>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Colonne principale avec le composant d'oraison --}}
            <div class="lg:col-span-2 animate-slide-up">
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 overflow-hidden 
                          transform transition-all duration-500 hover:shadow-2xl h-full">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-violet-900 font-serif flex items-center">
                                <x-heroicon-o-sparkles class="h-6 w-6 mr-2 text-violet-600 animate-spin-slow"/>
                                Oraison du Jour
                            </h2>
                            <span class="text-sm bg-violet-100 text-violet-800 px-3 py-1 rounded-full">Nouveau chaque jour</span>
                        </div>
                        
                        {{-- Composant principal d'oraison --}}
                        <div class="bg-gradient-to-br from-violet-50 to-blue-50 rounded-xl p-6 mb-6 border border-white/30 shadow-inner">
                            <livewire:oraison-picker />
                        </div>
                        
                        <div class="bg-white/80 rounded-lg p-4 border border-violet-100 mt-6">
                            <h3 class="font-semibold text-violet-800 mb-2 flex items-center">
                                <x-heroicon-o-light-bulb class="h-5 w-5 mr-2 text-amber-500"/>
                                Conseil spirituel
                            </h3>
                            <p class="text-violet-700">Prenez un moment de silence après la lecture pour laisser la Parole résonner en vous.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Colonne secondaire --}}
            <div class="animate-slide-up delay-100">
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 overflow-hidden h-full transform transition-all duration-500">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-violet-900 font-serif mb-6 flex items-center">
                            <x-heroicon-o-bookmark class="h-6 w-6 mr-2 text-violet-600"/>
                            Votre Carnet de Prière
                        </h2>
                        
                        <div class="space-y-6">
                            <div class="bg-gradient-to-br from-blue-50 to-violet-50 rounded-xl p-5 border border-blue-100 shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-violet-800 mb-2">Prière du Matin</h3>
                                <p class="text-violet-700 text-sm mb-3">"Seigneur, guide mes pas en ce nouveau jour..."</p>
                                
                            </div>
                            
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-5 border border-amber-100 shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-amber-800 mb-2">Action de Grâces</h3>
                                <p class="text-amber-700 text-sm mb-3">"Merci mon Dieu pour les bienfaits de cette journée..."</p>
                                
                            </div>
                            
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-5 border border-emerald-100 shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-emerald-800 mb-2">Prière du Soir</h3>
                                <p class="text-emerald-700 text-sm mb-3">"Père céleste, je te remets cette journée entre tes mains..."</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Animations personnalisées */
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
    
    @keyframes spinSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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
    
    .animate-spin-slow {
        animation: spinSlow 8s linear infinite;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
    }
    
    .transform {
        transition: all 0.3s ease-in-out;
    }
    
    body {
        font-family: 'Nunito', sans-serif;
        background-attachment: fixed;
    }
    
    .shadow-inner {
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    /* Effet de verre amélioré */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
</style>
@endpush