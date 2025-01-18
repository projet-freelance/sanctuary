@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto px-4 py-12">
        {{-- En-tête avec symbole chrétien --}}
        <div class="text-center mb-16">
            <div class="inline-block text-amber-600 mb-6">
                <svg class="w-12 h-12 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L14 7H10L12 2Z" />
                    <path d="M12 7V22" />
                    <path d="M7 12H17" />
                </svg>
            </div>
            <h1 class="text-4xl font-serif text-gray-800 mb-4">Radios Partenaires</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Découvrez notre sélection de radios chrétiennes pour nourrir votre foi et vous accompagner dans votre cheminement spirituel.
            </p>
        </div>

        {{-- Grille des radios --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($radios as $radio)
            <div class="group">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative">
                        <img 
                            src="{{ asset('logos' . $radio->logo) }}" 
                            alt="{{ $radio->name }}"
                            class="w-full h-48 object-cover"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-serif text-gray-800 mb-4">{{ $radio->name }}</h3>
                        <a 
                            href="{{ $radio->url }}" 
                            target="_blank"
                            class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700 transition-colors duration-300"
                        >
                            Écouter la radio
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Citation biblique --}}
        <div class="mt-16 text-center">
            <blockquote class="italic text-gray-600 max-w-3xl mx-auto">
                "Que tout ce qui respire loue l'Éternel! Louez l'Éternel!"
                <footer class="mt-2 text-sm">- Psaume 150:6</footer>
            </blockquote>
        </div>
    </div>
</div>

{{-- Styles spécifiques --}}
<style>
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>
@endsection