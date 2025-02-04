@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="relative h-[300px] lg:h-[400px]">
                    <img 
                        src="{{ asset('storage/' . $event->image) }}" 
                        alt="{{ $event->name }}" 
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent lg:hidden"></div>
                    <h1 class="absolute bottom-4 left-4 text-2xl font-bold text-white lg:hidden">
                        {{ $event->name }}
                    </h1>
                </div>
                <div class="p-4 lg:p-6">
                    <h1 class="hidden lg:block text-3xl font-bold text-gray-900 mb-4">
                        {{ $event->name }}
                    </h1>
                    <div class="prose max-w-none mb-6">
                        <p class="text-gray-600 text-sm">{{ $event->description }}</p>
                    </div>
                    <div class="space-y-4 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Détails de l'événement</h2>
                        <div class="grid gap-3">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar text-blue-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Date et heure</p>
                                    <p class="text-sm text-gray-900">
                                        {{ $event->date_time ? \Carbon\Carbon::parse($event->date_time)->format('d/m/Y H:i') : 'Date non définie' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-red-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Lieu</p>
                                    <p class="text-sm text-gray-900">{{ $event->location }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-ticket-alt text-green-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Prix du billet</p>
                                    <p class="text-sm text-gray-900">{{ number_format($event->ticket_price, 2) }} €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 border border-red-300 rounded-md p-4 mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('events.purchase', ['event' => $event->id]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-700">
                                    Nombre de places disponibles : <span class="font-bold">{{ $event->available_seats }}</span>
                                </p>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre de places à acheter
                                </label>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="decrease" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md">-</button>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        id="quantity" 
                                        class="w-16 text-center border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        min="1"
                                        max="{{ min(10, $event->available_seats) }}"
                                        value="1"
                                        required
                                    >
                                    <button type="button" id="increase" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md">+</button>
                                </div>
                            </div>
                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-semibold hover:bg-blue-700 transition duration-200 flex items-center justify-center space-x-2"
                                {{ $event->available_seats == 0 ? 'disabled' : '' }}
                            >
                                <i class="fas fa-shopping-cart"></i>
                                <span>Réserver maintenant</span>
                            </button>
                            @if ($event->available_seats == 0)
                                <p class="text-red-500 text-sm mt-2 text-center">Cet événement est complet.</p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const decreaseBtn = document.getElementById("decrease");
    const increaseBtn = document.getElementById("increase");
    const quantityInput = document.getElementById("quantity");

    decreaseBtn.addEventListener("click", function () {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });

    increaseBtn.addEventListener("click", function () {
        let value = parseInt(quantityInput.value);
        let max = parseInt(quantityInput.max);
        if (value < max) {
            quantityInput.value = value + 1;
        }
    });
});
</script>
@endsection
