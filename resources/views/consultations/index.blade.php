@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50">
    <!-- Hero Section avec animation subtile -->
    <div class="relative bg-gradient-to-r from-purple-800 to-blue-800 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
            <div class="text-center space-y-8 animate-fade-in">
                <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white to-purple-100">
                    Accompagnement Spirituel Personnalisé
                </h1>
                <p class="text-xl md:text-2xl font-light max-w-3xl mx-auto leading-relaxed text-purple-100">
                    Un espace de confiance et de sérénité pour votre cheminement spirituel
                </p>
                <div class="mt-8">
                    <a href="{{ route('consultations.create') }}" 
                        class="group inline-flex items-center px-8 py-4 rounded-full text-lg font-medium bg-white text-purple-900 hover:bg-purple-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <span class="mr-3">Commencer votre voyage</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services avec design amélioré -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-3 gap-10">
            @foreach([
                [
                    'title' => 'Souscription',
                    'description' => 'Choisissez votre forfait et inscrivez-vous en quelques clics',
                    'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6'
                ],
                [
                    'title' => 'Rendez-vous',
                    'description' => 'Réservez instantanément votre créneau avec un guide spirituel',
                    'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
                ],
                [
                    'title' => 'Consultation',
                    'description' => 'Échangez en toute confidentialité lors de votre session personnalisée',
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                ]
            ] as $service)
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-shadow h-full flex flex-col">
                    <div class="bg-gradient-to-br from-purple-100 to-blue-100 rounded-xl w-20 h-20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl mb-4 text-purple-900">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $service['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Types de consultations -->
        <div class="mt-20 space-y-8">
            @foreach([
                [
                    'title' => 'Consultation Spirituelle',
                    'description' => 'Guidance personnalisée pour vos questions spirituelles et votre cheminement de foi'
                ],
                [
                    'title' => 'Prière et Intercession',
                    'description' => 'Moment de prière partagée pour vos intentions particulières'
                ],
                [
                    'title' => 'Confession',
                    'description' => 'Espace confidentiel pour le sacrement de réconciliation'
                ]
            ] as $consultation)
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div class="bg-gradient-to-r from-purple-100 to-blue-100 rounded-xl p-4">
                            <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-2xl mb-2 text-purple-900">{{ $consultation['title'] }}</h3>
                        <p class="text-gray-600">{{ $consultation['description'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

       <!-- Section des consultations programmées -->
<div class="mt-20">
    <div class="bg-white rounded-2xl shadow-xl p-10">
        <h2 class="text-3xl font-bold mb-8 text-purple-900 text-center">Prêt à commencer ?</h2>
        <p class="text-gray-600 mb-10 text-lg text-center max-w-2xl mx-auto">
            Nos guides spirituels sont là pour vous accompagner dans votre cheminement avec bienveillance et expertise
        </p>
        
        @if($consultations->isEmpty())
            <div class="text-center">
                <a href="{{ route('consultations.create') }}" 
                    class="inline-flex items-center px-8 py-4 rounded-full text-lg font-medium text-white bg-gradient-to-r from-purple-700 to-blue-700 hover:from-purple-800 hover:to-blue-800 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    <span class="mr-3">Prendre rendez-vous</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        @else
            <div class="space-y-6">
                <h3 class="font-bold text-2xl text-purple-900 mb-6">Vos consultations programmées</h3>
                <div class="space-y-4">
                    @foreach($consultations->sortByDesc('created_at') as $consultation)
                        <div class="bg-white border {{ $loop->first ? 'border-green-200 ring-1 ring-green-100' : 'border-gray-100' }} rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if($loop->first)
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <p class="text-lg font-medium text-gray-900">
                                                {{ ucfirst($consultation->type) }}
                                            </p>
                                            @if($loop->first)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Nouvelle
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-gray-500 mt-1">
                                            @if($consultation->scheduled_at)
                                                {{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d/m/Y à H:i') }}
                                            @else
                                                Non programmée
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-6">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                        @if($consultation->status === 'confirmé')
                                            bg-green-100 text-green-800
                                        @elseif($consultation->status === 'en_attente')
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($consultation->status) }}
                                    </span>
                                    <a href="{{ route('consultations.show', $consultation->id) }}" 
                                        class="inline-flex items-center text-purple-700 hover:text-purple-900 font-medium group">
                                        <span>Voir détails</span>
                                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
        <!-- Section garanties -->
        <div class="mt-20 grid md:grid-cols-2 gap-10">
            @foreach([
                [
                    'title' => 'Confidentialité Absolue',
                    'description' => 'Vos échanges sont protégés et restent strictement confidentiels',
                    'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                    'color' => 'green'
                ],
                [
                    'title' => 'Accompagnement Bienveillant',
                    'description' => 'Une écoute attentive et un soutien spirituel adapté à vos besoins',
                    'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
                    'color' => 'blue'
                ]
            ] as $guarantee)
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-{{ $guarantee['color'] }}-100 w-16 h-16 flex items-center justify-center">
                            <svg class="h-8 w-8 text-{{ $guarantee['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $guarantee['icon'] }}"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-2xl mb-2 text-purple-900">{{ $guarantee['title'] }}</h3>
                        <p class="text-gray-600">{{ $guarantee['description'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection