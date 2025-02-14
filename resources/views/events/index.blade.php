@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Événements à venir</h1>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($newEvents as $event) <!-- Boucle sur les événements -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Image de l'événement -->
                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">
                
                <div class="p-4">
                    <!-- Nom de l'événement -->
                    <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                    
                    <!-- Date et heure de l'événement -->
                    <div class="mb-2">
                        <span class="text-gray-600">
                            <i class="fas fa-calendar"></i> {{ $event->date_time->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    
                    <!-- Lieu de l'événement -->
                    <div class="mb-2">
                        <span class="text-gray-600">
                            <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                        </span>
                    </div>
                    
                    <!-- Prix du ticket -->
                    <div class="mb-4">
                        <span class="text-lg font-bold text-green-600">
                            {{ number_format($event->ticket_price) }} FCFA
                        </span>
                    </div>
                    
                    <!-- Bouton "Voir détails" et disponibilité des places -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('events.show', $event->id) }}" 
                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        @empty($newEvents)
            <!-- Message si aucun événement n'est disponible -->
            <p class="col-span-full text-center text-gray-600">
                Aucun événement prévu actuellement.
            </p>
        @endempty <!-- Fin de la condition de vide -->
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $newEvents->links() }}
    </div>
</div>
@endsection
