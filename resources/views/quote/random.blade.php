@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Croix décorative -->
        <div class="flex justify-center mb-8">
            <div class="text-yellow-600 text-4xl">✝</div>
        </div>
        
        <!-- Carte principale -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
            <!-- En-tête décoratif -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-2"></div>
            
            <div class="p-6 sm:p-8">
                <h1 class="text-2xl sm:text-3xl font-serif text-center text-gray-800 mb-8">
                    {{ __('Médite une citation de saint') }}
                </h1>

                <!-- Section de la citation -->
                <div class="bg-gray-50 rounded-lg p-6 sm:p-8 mb-8">
                    <div class="flex items-start">
                        <span class="text-4xl text-gray-400 leading-none font-serif mr-4">"</span>
                        <p class="text-lg sm:text-xl text-gray-700 font-serif italic">
                            {{ $quote->quote }}
                        </p>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <p class="text-gray-600 font-medium">
                            - Saint {{ $quote->author }}
                        </p>
                    </div>
                </div>

                <!-- Section des actions -->
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('quote.random') }}" 
                       class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <span class="mr-2">🕊</span>
                        {{ __('Pioche une autre citation') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Ornement du bas -->
        <div class="flex justify-center mt-8">
            <div class="text-gray-400 text-2xl">❖</div>
        </div>
    </div>
</div>

<!-- Ajout du style personnalisé -->
<style>
    @media (max-width: 640px) {
        .font-serif {
            font-size: 95%;
            line-height: 1.6;
        }
    }
</style>
@endsection