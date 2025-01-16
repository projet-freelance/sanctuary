@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- En-tête avec recherche -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Enseignements</h1>
                <p class="mt-2 text-gray-600">Découvrez nos ressources spirituelles</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('teachings.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Ajouter un enseignement
                </a>
            </div>
        </div>

        <!-- Grille des enseignements -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($teachings as $teaching)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <!-- Badge type -->
                <div class="px-4 py-1 bg-gradient-to-r from-blue-500 to-blue-600">
                    <span class="text-xs font-medium text-white uppercase tracking-wider">
                        {{ $teaching->type }}
                        @if ($teaching->is_live)
                            • EN DIRECT
                        @endif
                    </span>
                </div>

                <div class="p-6">
                    <!-- Titre et description -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $teaching->title }}</h2>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ $teaching->description }}</p>
                    </div>

                    <!-- Contenu dynamique -->
                    <div class="mb-4">
                        @if ($teaching->type === 'audio')
                            <div class="bg-gray-50 rounded-lg p-3">
                                <audio controls src="{{ asset('storage/' . $teaching->url) }}" 
                                       class="w-full focus:outline-none" 
                                       style="height: 40px;">
                                </audio>
                            </div>
                        @elseif ($teaching->type === 'video')
                            <div class="relative aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-gray-100">
                                <iframe src="{{ $teaching->url }}" 
                                        class="absolute inset-0 w-full h-full"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                            </div>
                        @elseif ($teaching->type === 'text')
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 text-sm line-clamp-3">{{ $teaching->description }}</p>
                            </div>
                        @elseif ($teaching->type === 'link')
                            <a href="{{ $teaching->url }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Accéder au contenu partenaire
                            </a>
                        @endif
                    </div>

                    <!-- Pied de carte -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        @if ($teaching->is_live)
                            <div class="flex items-center text-green-600">
                                <span class="flex h-3 w-3 relative mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm">
                                    {{ \Carbon\Carbon::parse($teaching->live_start_at)->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        @endif
                        
                        <a href="{{ route('teachings.show', $teaching) }}" 
                           class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200">
                            Voir plus
                            <svg class="ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Styles spécifiques -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection