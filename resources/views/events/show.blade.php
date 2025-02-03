<!-- resources/views/events/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="md:flex -mx-4">
        <div class="md:w-1/2 px-4">
            <img src="{{ asset('storage/' . $event->image) }}" 
                 alt="{{ $event->name }}" 
                 class="rounded-lg shadow-lg w-full h-96 object-cover">
        </div>
        
        <div class="md:w-1/2 px-4">
            <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>
            
            <div class="mb-4">
                <p class="text-gray-700">{{ $event->description }}</p>
            </div>
            
            <div class="mb-4">
                <h2 class="font-semibold">Détails</h2>
                <ul class="space-y-2">
                    <li>
                        <i class="fas fa-calendar text-blue-500"></i>
                        {{ $event->date_time ? \Carbon\Carbon::parse($event->date_time)->format('d/m/Y H:i') : 'Date non définie' }}

                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt text-red-500"></i>
                        {{ $event->location }}
                    </li>
                    <li>
                        <i class="fas fa-ticket-alt text-green-500"></i>
                        {{ number_format($event->ticket_price, 2) }} €
                    </li>
                </ul>
            </div>
            
            <div class="mb-4">
                @if($event->hasAvailableSeats())
                    <form action="{{ route('events.purchase', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="quantity" class="block mb-2">Nombre de places</label>
                            <select name="quantity" id="quantity" class="w-full rounded border p-2">
                                @for($i = 1; $i <= min(10, $event->available_seats); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                            Acheter des billets
                        </button>
                    </form>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        Désolé, cet événement est complet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection