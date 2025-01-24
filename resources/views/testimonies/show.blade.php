
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-6">
                    <i class="fas fa-comment-dots text-3xl text-blue-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $testimony->title }}</h1>
            </div>

            <div class="mb-6">
                <span class="text-sm text-gray-600">
                    <i class="fas fa-user mr-2 text-blue-500"></i>
                    Partagé par {{ $testimony->user->name ?? 'Anonyme' }}
                    <span class="mx-2">•</span>
                    {{ $testimony->created_at->translatedFormat('d F Y') }}
                </span>
            </div>

            @if($testimony->type == 'écrit')
                <div class="prose max-w-none text-gray-800 mb-8">
                    {{ $testimony->content }}
                </div>
            @elseif($testimony->type == 'vocal')
                <div class="bg-blue-50 rounded-lg p-6 mb-8 text-center">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">
                        <i class="fas fa-volume-up mr-2 text-blue-600"></i>
                        Témoignage Audio
                    </h3>
                    <audio controls class="w-full">
                        <source src="{{ asset('storage/' . $testimony->audio_path) }}" type="audio/mp3">
                        Votre navigateur ne supporte pas l'élément audio.
                    </audio>
                </div>
            @endif

            <div class="flex justify-between items-center">
                <a href="{{ route('testimonies.index') }}" 
                    class="inline-flex items-center px-4 py-2 
                    border border-transparent text-sm font-medium 
                    rounded-full shadow-sm text-white 
                    bg-blue-500 hover:bg-blue-600 
                    transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux Témoignages
                </a>
            </div>
        </div>
    </div>
</div>
@endsection