@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- En-tête avec navigation -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('teachings.index') }}" class="hover:text-gray-700">Enseignements</a>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ Str::limit($teaching->title, 40) }}</span>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- En-tête de l'enseignement -->
            <div class="p-6 sm:p-8 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $teaching->title }}</h1>
                        @if ($teaching->is_live)
                            <div class="mt-4 flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <span class="flex h-2 w-2 relative mr-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    EN DIRECT
                                </span>
                                <span class="text-sm text-gray-500">
                                    Début : {{ $teaching->live_start_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($teaching->type) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="p-6 sm:p-8 bg-gray-50 border-b border-gray-200">
                <p class="text-gray-700 text-lg leading-relaxed">{{ $teaching->description }}</p>
            </div>

            <!-- Contenu principal -->
            <div class="p-6 sm:p-8">
                @if ($teaching->type == 'audio')
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="max-w-3xl mx-auto">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Écouter l'enseignement</h2>
                            <audio controls class="w-full focus:outline-none">
                                <source src="{{ asset('storage/' . $teaching->url) }}" type="audio/mpeg">
                                <p class="text-gray-500 text-sm">Votre navigateur ne supporte pas la balise audio.</p>
                            </audio>
                        </div>
                    </div>
                @elseif ($teaching->type == 'video')
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="max-w-4xl mx-auto">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Regarder l'enseignement</h2>
                            <div class="relative aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-black">
                                <video controls class="absolute inset-0 w-full h-full">
                                    <source src="{{ asset('storage/' . $teaching->url) }}" type="video/mp4">
                                    <p class="text-gray-500 text-sm">Votre navigateur ne supporte pas la balise vidéo.</p>
                                </video>
                            </div>
                        </div>
                    </div>
                @elseif ($teaching->type == 'text')
                    <div class="prose prose-blue max-w-none">
                        {{ $teaching->description }}
                    </div>
                @elseif ($teaching->type == 'link')
                    <div class="bg-blue-50 rounded-lg p-6 text-center">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Accéder au contenu externe</h2>
                        <a href="{{ $teaching->url }}" 
                           target="_blank" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Voir l'événement
                        </a>
                        <p class="mt-2 text-sm text-gray-500">Le contenu s'ouvrira dans un nouvel onglet</p>
                    </div>
                @endif
            </div>

            <!-- Pied de page -->
            <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-6 flex justify-between items-center">
                <a href="{{ route('teachings.index') }}" 
                   class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors duration-200">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Retour aux enseignements
                </a>
                
                
            </div>
        </div>
    </div>
</div>

<style>
    /* Style personnalisé pour les contrôles audio/vidéo */
    audio::-webkit-media-controls-panel,
    video::-webkit-media-controls-panel {
        background-color: #f3f4f6;
    }
    
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%;
    }
    
    .aspect-h-9 {
        position: relative;
    }
</style>
@endsection