@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête du profil -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 sm:px-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-16 w-16 rounded-full bg-white/20 flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                            <p class="text-blue-100">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        @if($user->status === 'active')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                Actif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                                Inactif
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informations personnelles -->
            <div class="px-6 py-6 sm:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Informations personnelles</h2>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-600">{{ $user->phone ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-600">{{ $user->city ?? 'Non renseignée' }}, {{ $user->country ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') : 'Non renseignée' }}
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques d'activité -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Activités</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <p class="text-sm text-blue-600 font-medium">Témoignages</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $user->testimonies->count() }}</p>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4">
                                <p class="text-sm text-purple-600 font-medium">Prières</p>
                                <p class="text-2xl font-bold text-purple-900">{{ $user->prayers->count() }}</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <p class="text-sm text-green-600 font-medium">Commandes</p>
                                <p class="text-2xl font-bold text-green-900">{{ $user->orders->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 sm:px-8 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour
                    </a>
                    <a href="{{ route('profile.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection