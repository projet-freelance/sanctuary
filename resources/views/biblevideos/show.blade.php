@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- En-tête avec navigation -->
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('biblevideos.index') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux vidéos
                </a>
            </div>

            <!-- Carte principale -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Conteneur vidéo responsive -->
                <div class="relative pb-[56.25%] h-0 bg-gray-900">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="{{ $video->url }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Contenu -->
                <div class="p-6 md:p-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $video->title }}</h1>
                    
                    @if($video->duration)
                        <div class="flex items-center text-gray-500 mb-6">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $video->duration }}</span>
                        </div>
                    @endif

                    @if($video->description)
                        <div class="prose max-w-none">
                            <h2 class="text-xl font-semibold text-gray-800 mb-3">À propos de cette vidéo</h2>
                            <div class="text-gray-600 space-y-4">
                                {!! nl2br(e($video->description)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation entre vidéos (si disponible) -->
            @if(isset($previousVideo) || isset($nextVideo))
                <div class="mt-8 flex justify-between items-center">
                    @if(isset($previousVideo))
                        <a href="{{ route('biblevideos.show', $previousVideo->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Vidéo précédente
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if(isset($nextVideo))
                        <a href="{{ route('biblevideos.show', $nextVideo->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition-colors">
                            Vidéo suivante
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection