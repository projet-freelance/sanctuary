@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-3xl font-bold text-center mb-6">Liste des Prières</h1>

        @foreach ($prayers as $prayer)
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $prayer->intention }}</h2>
            <p class="text-lg text-gray-600"><strong>Type :</strong> {{ $prayer->prayer_type }}</p>
            <p class="text-lg text-gray-600"><strong>Statut :</strong> {{ $prayer->status }}</p>
            <p class="text-lg text-gray-600"><strong>Catégorie :</strong> {{ $prayer->category }}</p>

            <div class="mt-4">
                <a href="{{ route('prayers.show', $prayer) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                    Voir Détail
                </a>
            </div>
        </div>
        <hr class="border-t-2 border-gray-200">
        @endforeach
    </div>

   
</div>

@endsection
