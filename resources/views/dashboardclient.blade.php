@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-between py-12 bg-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Section du verset du jour -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-bold">Verset du jour</h2>
                <p class="mt-4 text-gray-600">
                    {{ $verseText ?? 'Aucun verset disponible.' }}
                </p>
                <p class="mt-2 text-sm text-gray-500">
                    <em>{{ $verseReference ?? '' }}</em>
                </p>
            </div>
        </div>
    </div>

    <!-- Events Section -->
<div class="bg-white rounded-xl shadow-xl p-8 mb-8">
    <h2 class="text-3xl font-bold mb-8 text-purple-900">Événements à Venir</h2>
    
    <div class="space-y-6">
        <!-- Event Card -->
        <div class="bg-purple-50 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="flex-1">
                    <h3 class="font-semibold text-xl mb-2 text-purple-900">Retraite Spirituelle</h3>
                    <p class="text-gray-600">Une retraite de 3 jours pour se recentrer sur sa foi et rencontrer d'autres croyants.</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>25 - 27 Octobre 2023</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Centre Spirituel de Montagne</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 md:ml-4">
                    <a href="{{ route('events.show', 1) }}" 
                        class="inline-flex items-center px-6 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        Acheter un ticket
                    </a>
                </div>
            </div>
        </div>

        <!-- Add more events here -->
    </div>
</div>

    <!-- Section Exercice Spirituel (Livewire) -->
    <div class="mt-6">
    <livewire:counter />

    </div>

    <!-- Section du pied de page si aucun verset -->
    @if (!$verseText)
        <footer class="bg-blue-800 text-white py-6 mt-6">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                <div class="mt-4">
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('À propos') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Confidentialité') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Conditions d\'utilisation') }}</a>
                </div>
            </div>
        </footer>
    @endif
</div>
@endsection
