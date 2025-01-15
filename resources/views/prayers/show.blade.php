@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">
    <div class="container mx-auto p-6 flex-grow">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $prayer->title }}</h1>
            
            @if ($prayer->message)
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Message</h2>
                <p class="text-lg text-gray-600">{{ $prayer->message }}</p>
            </div>
            @endif

            @if ($prayer->getFirstMediaUrl('audio'))
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Audio</h2>
                <audio controls>
                    <source src="{{ $prayer->getFirstMediaUrl('audio') }}" type="audio/mpeg">
                    Votre navigateur ne supporte pas la lecture audio.
                </audio>
            </div>
            <div>
                <p>Créée par : {{ $prayer->user->name }}</p>
            </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('prayers.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                    Retour à la liste des prières
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
