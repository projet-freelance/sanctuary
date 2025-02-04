@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            {{-- Colonne Versets du Jour --}}
            <div class="w-full">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Versets du Jour
                        </h2>
                        <livewire:dailyverses />
                    </div>
                </div>
            </div>

            {{-- Colonne Exercice Spirituel --}}
            <div class="w-full">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-green-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            </svg>
                            Exercice Spirituel
                        </h2>
                        <livewire:counter />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- Styles personnalisés --}}
@push('styles')
<style>
    /* Animation de survol subtile */
    .hover\:shadow-2xl:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease;
    }
</style>
@endpush