@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="bg-indigo-900 text-white p-6">
            <h1 class="text-3xl font-serif">{{ $prayer->title }}</h1>
        </div>
        
        <div class="p-8">
            @if ($prayer->message)
            <div class="mb-8">
                <h2 class="text-xl font-serif text-indigo-900 mb-4">Message de Prière</h2>
                <div class="bg-blue-50 p-6 rounded-lg border border-indigo-100">
                    <p class="text-gray-700 leading-relaxed">{{ $prayer->message }}</p>
                </div>
            </div>
            @endif

            @if ($prayer->getFirstMediaUrl('audio'))
            <div class="mb-8">
                <h2 class="text-xl font-serif text-indigo-900 mb-4">Méditation Audio</h2>
                <div class="bg-blue-50 p-6 rounded-lg border border-indigo-100">
                    <audio controls class="w-full">
                        <source src="{{ $prayer->getFirstMediaUrl('audio') }}" type="audio/mpeg">
                        Votre navigateur ne supporte pas la lecture audio.
                    </audio>
                </div>
            </div>
            @endif

            <div class="mt-6 text-gray-600">
                <i class="fas fa-user mr-2"></i>
                Partagée par : {{ $prayer->user->name }}
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6">
                <a href="{{ route('prayers.index') }}" 
                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux prières
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
