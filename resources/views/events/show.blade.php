@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-xl p-8">
            <!-- Titre de l'événement -->
            <h1 class="text-3xl font-bold mb-6 text-purple-900">{{ $event->title }}</h1>
            
            <!-- Dates et lieu de l'événement -->
            <div class="space-y-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }} - 
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                    </span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>
            </div>

            <!-- Description de l'événement -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-purple-900">Description de l'Événement</h2>
                <p class="text-gray-600">{{ $event->description }}</p>
            </div>

            <!-- Formulaire d'achat de tickets -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-purple-900">Acheter un Ticket</h2>
                <form action="{{ route('events.purchase', $event->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Champ pour le nombre de tickets -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Nombre de tickets</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        <!-- Bouton d'achat -->
                        <div>
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Acheter maintenant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection