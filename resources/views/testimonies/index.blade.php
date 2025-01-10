@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-3xl font-bold text-center mb-6">Témoignages</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('testimonies.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 transition duration-300">
                Ajouter un témoignage
            </a>
        </div>

        <!-- Liste des témoignages -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonies as $testimony)
            <div class="bg-white p-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                <h5 class="text-xl font-semibold text-gray-800 mb-2">{{ $testimony->title }}</h5>
                <p class="text-gray-600 mb-4">{{ Str::limit($testimony->content, 100) }}</p>
                <a href="{{ route('testimonies.show', $testimony->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    Voir
                </a>
            </div>
            @endforeach
        </div>
    </div>

   
</div>
@endsection
