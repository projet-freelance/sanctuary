@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-between py-12 bg-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-bold">Verset du jour</h2>
                <p class="mt-4 text-gray-600">
                    {{ $verseText ?? 'Aucun verset disponible.' }}
                </p>
                <p class="mt-2 text-sm text-gray-500">
                    <em>{{ $verseReference ?? '' }}</em>
                </p>
            </div>
        </div>
    </div>

    @if (!$verseText)
        <!-- Footer will take the remaining space if there's no verse -->
        <footer class="bg-blue-800 text-white py-6 mt-6">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                <div class="mt-4">
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('À propos') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Confidentialité') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Conditions d\'utilisation') }}</a>
                </div>
            </div>
        </footer>
    @endif
</div>
@endsection
