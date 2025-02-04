@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        <!-- Main Content Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Image and Details Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Image Section -->
                <div class="relative h-[300px] lg:h-[400px]">
                    <img 
                        src="{{ asset('storage/' . $event->image) }}" 
                        alt="{{ $event->name }}" 
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                    <!-- Gradient Overlay for Mobile -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent lg:hidden"></div>
                    <!-- Mobile Title Overlay -->
                    <h1 class="absolute bottom-4 left-4 text-2xl font-bold text-white lg:hidden">
                        {{ $event->name }}
                    </h1>
                </div>

                <!-- Details Section -->
                <div class="p-4 lg:p-6">
                    <!-- Desktop Title -->
                    <h1 class="hidden lg:block text-3xl font-bold text-gray-900 mb-4">
                        {{ $event->name }}
                    </h1>

                    <!-- Description -->
                    <div class="prose max-w-none mb-6">
                        <p class="text-gray-600 text-sm">{{ $event->description }}</p>
                    </div>

                    <!-- Event Details -->
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

                    <!-- Ticket Purchase Form -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <form action="{{ route('events.purchase', ['event' => $event->id]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre de places
                                </label>
                                <select 
                                    name="quantity" 
                                    id="quantity" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                >
                                    @for($i = 1; $i <= min(10, $event->available_tickets); $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'billet' : 'billets' }}</option>
                                    @endfor
                                </select>
                            </div>
                            
                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-semibold hover:bg-blue-700 transition duration-200 flex items-center justify-center space-x-2"
                            >
                                <i class="fas fa-shopping-cart"></i>
                                <span>Réserver maintenant</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection