@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl sm:text-4xl font-bold text-center text-blue-900 mb-8">
            <i class="fas fa-testimonial text-red-500 mr-3"></i>Témoignages de Foi
        </h1>

        <div class="mb-8 text-center">
            <a href="{{ route('testimonies.create') }}" class="inline-flex items-center px-6 py-3 
                border border-transparent text-base font-medium rounded-full shadow-lg 
                text-white bg-blue-600 hover:bg-blue-700 focus:outline-none 
                transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                <i class="fas fa-plus-circle mr-2"></i>Ajouter un Témoignage
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonies as $testimony)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden 
                    transform transition duration-300 hover:shadow-2xl hover:-translate-y-2 
                    border-l-4 border-blue-500 hover:border-red-500">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-quote-left text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 truncate">
                                {{ $testimony->title }}
                            </h3>
                        </div>
                        
                        <p class="text-gray-600 mb-4 text-sm">
                            <span class="font-semibold">Partagé par</span> 
                            {{ $testimony->user->name ?? 'Anonyme' }}
                        </p>
                        
                        <p class="text-gray-700 mb-4 h-24 overflow-hidden">
                            {{ Str::limit($testimony->content, 150) }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">
                                {{ $testimony->created_at->diffForHumans() }}
                            </span>
                            
                            <a href="{{ route('testimonies.show', $testimony->id) }}" 
                                class="inline-flex items-center px-3 py-1.5 
                                border border-transparent text-xs font-medium 
                                rounded-full shadow-sm text-white 
                                bg-blue-500 hover:bg-blue-600 
                                transition duration-300">
                                Lire Plus
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md">
                    <i class="fas fa-comment-slash text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Aucun témoignage pour le moment</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection