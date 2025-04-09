@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br bg-purple-100  flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow">
        {{-- Bouton de retour avec animation --}}
        <a href="{{ route('dashboard') }}" class="inline-flex items-center mb-6  hover:text-blue-600 transition-colors duration-300 group">
            <x-heroicon-o-arrow-left class="h-5 w-5 mr-2 transform group-hover:-translate-x-1 transition-transform"/>
            <span class="group-hover:underline">Retour au tableau de bord</span>
        </a>
        
        {{-- En-tête avec effet de verre --}}
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-2/3 p-8">
                    <h1 class="text-4xl font-bold text-indigo-900 font-serif mb-3">Pick-Ange</h1>
                    <p class="text-lg text-violet-700 mb-4 italic">"Recevez un message céleste pour guider votre journée"</p>
                    <div class="bg-gradient-to-r from-indigo-100 to-violet-100 rounded-xl p-4 border-l-4 border-indigo-400">
                        <p class="text-indigo-800">Chaque ange porte un message unique de paix, d'espérance et d'amour divin. Ouvrez votre cœur à cette guidance céleste.</p>
                    </div>
                </div>
                <div class="md:w-1/3 bg-gradient-to-br from-indigo-100/70 to-violet-100/70 flex items-center justify-center p-8 relative overflow-hidden">
                    <div class="text-center z-10">
                        <div class="text-indigo-500 mb-3 animate-float">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <p class="text-indigo-800 font-semibold text-lg">Inspiration divine</p>
                    </div>
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-indigo-300 rounded-full filter blur-xl"></div>
                        <div class="absolute bottom-1/3 right-1/4 w-20 h-20 bg-violet-300 rounded-full filter blur-xl"></div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Section principale --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Colonne principale --}}
            <div class="lg:col-span-8 animate-slide-up">
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden transform transition-all duration-500 hover:shadow-3xl">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">Message du jour</span>
                        </div>
                        
                        {{-- Pick-Ange interactif --}}
                        <div class="bg-gradient-to-br from-indigo-50/80 to-violet-50/80 rounded-2xl p-8 mb-8 border border-white/30 shadow-inner relative overflow-hidden">
                            <div class="absolute inset-0 bg-[url('https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg')] bg-cover opacity-10"></div>
                            <div class="relative z-10">
                                <livewire:pick-ange />
                            </div>
                        </div>
                        
                     
                      
            
           
                
               
                   
                
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }
    
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
    
    .animate-pulse {
        animation: pulse 3s ease-in-out infinite;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
    }
    
    /* Effets de transition */
    .transform {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Typographie */
    body {
        font-family: 'Nunito', sans-serif;
        background-attachment: fixed;
    }
    
    /* Effets visuels */
    .shadow-inner {
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
    
    .shadow-2xl {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .shadow-3xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endpush