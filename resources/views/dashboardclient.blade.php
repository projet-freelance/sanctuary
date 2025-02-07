@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow space-y-6">
        {{-- Versets du Jour --}}
        <div class="w-full">
            <div class="bg-white rounded-3xl shadow-lg border border-blue-100 overflow-hidden 
                        transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="p-6 bg-blue-50 bg-opacity-50">
                    <h2 class="text-2xl font-extrabold text-blue-900 mb-4 flex items-center">
                        <x-heroicon-o-book-open class="h-7 w-7 mr-3 text-blue-600"/>
                        Versets du Jour
                    </h2>
                    <livewire:dailyverses />
                </div>
            </div>
        </div>

        {{-- Exercice Spirituel --}}
        <div class="w-full">
            <div class="bg-white rounded-3xl shadow-lg border border-green-100 overflow-hidden 
                        transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="p-6 bg-green-50 bg-opacity-50">
                    <h2 class="text-2xl font-extrabold text-green-900 mb-4 flex items-center">
                        <x-heroicon-o-sparkles class="h-7 w-7 mr-3 text-green-600"/>
                        Exercice Spirituel
                    </h2>
                    <livewire:counter />
                </div>
            </div>
        </div>

        {{-- Oraison Spirituel --}}
        <div class="w-full">
            <div class="bg-white rounded-3xl shadow-lg border border-purple-100 overflow-hidden 
                        transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="p-6 bg-purple-50 bg-opacity-50">
                    <h2 class="text-2xl font-extrabold text-purple-900 mb-4 flex items-center">
                        <x-heroicon-o-heart class="h-7 w-7 mr-3 text-purple-600"/>
                        Oraison Spirituel
                    </h2>
                    <livewire:oraison-picker />
                </div>
            </div>
        </div>

        {{-- Pick Ange Section --}}
        <div class="w-full">
            <livewire:pick-ange />
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .transform {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
</style>
@endpush