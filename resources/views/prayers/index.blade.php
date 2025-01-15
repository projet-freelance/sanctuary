@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-3xl font-bold text-center mb-6">Liste des Prières</h1>

        @foreach ($prayers as $prayer)
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $prayer->title }}</h2>

            <div class="mt-4">
                <a href="{{ route('prayers.show', $prayer) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                    Voir Détail
                </a>
            </div>
        </div>
        <hr class="border-t-2 border-gray-200">
        @endforeach
    </div>
    
    <div class="mt-6 text-center">
        <a href="{{ route('prayers.create')}}" class="text-blue-600 hover:underline font-semibold">
            Créer une Prière
        </a>
    </div>
</div>
@endsection
