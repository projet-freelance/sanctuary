@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Vidéos des Histoires de la Bible</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Découvrez les histoires bibliques à travers notre collection de vidéos inspirantes</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($videos as $video)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        @if($video->url)
                            @php
                                $video_id = substr(parse_url($video->url, PHP_URL_PATH), -11); // Extraire l'ID de la vidéo de l'URL
                                $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/0.jpg"; // Générer l'URL de la miniature
                            @endphp
                            <img src="{{ $thumbnail_url }}" alt="{{ $video->title }}" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-300">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">{{ $video->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $video->description }}</p>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('biblevideos.show', $video->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <span>Regarder</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            
                            <span class="text-sm text-gray-500">
                                {{ $video->duration ?? '00:00' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(method_exists($videos, 'links'))
            <div class="mt-12">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
