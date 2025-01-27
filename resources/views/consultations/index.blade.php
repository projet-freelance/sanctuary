@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-700 to-blue-700 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Accompagnement Spirituel Personnalisé</h1>
            <p class="text-xl md:text-2xl font-light">Un espace de confiance pour partager vos préoccupations et recevoir du soutien spirituel</p>
            <div class="mt-8">
                <a href="{{ route('consultations.create') }}" 
                    class="inline-flex items-center px-8 py-3 border border-transparent rounded-full text-lg font-medium text-purple-900 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg">
                    Commencer maintenant
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
        <!-- Process Steps -->
        <div class="bg-white rounded-xl shadow-xl p-8 mb-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-purple-900">Comment ça fonctionne ?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <span class="text-purple-700 text-3xl font-bold">1</span>
                    </div>
                    <h3 class="font-semibold text-xl mb-3 text-purple-900">Souscription</h3>
                    <p class="text-gray-600">Choisissez votre forfait et inscrivez-vous en quelques clics</p>
                </div>

                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <span class="text-purple-700 text-3xl font-bold">2</span>
                    </div>
                    <h3 class="font-semibold text-xl mb-3 text-purple-900">Rendez-vous</h3>
                    <p class="text-gray-600">Réservez instantanément votre créneau avec un guide spirituel</p>
                </div>

                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <span class="text-purple-700 text-3xl font-bold">3</span>
                    </div>
                    <h3 class="font-semibold text-xl mb-3 text-purple-900">Consultation</h3>
                    <p class="text-gray-600">Échangez en toute confidentialité lors de votre session personnalisée</p>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="bg-white rounded-xl shadow-xl p-8 mb-8">
            <h2 class="text-3xl font-bold mb-8 text-purple-900">Nos Services d'Accompagnement</h2>
            
            <div class="space-y-6">
                <div class="bg-purple-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-xl mb-2 text-purple-900">Consultation Spirituelle</h3>
                    <p class="text-gray-600">Guidance personnalisée pour vos questions spirituelles et votre cheminement de foi</p>
                </div>

                <div class="bg-purple-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-xl mb-2 text-purple-900">Prière et Intercession</h3>
                    <p class="text-gray-600">Moment de prière partagée pour vos intentions particulières</p>
                </div>

                <div class="bg-purple-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-xl mb-2 text-purple-900">Confession et Réconciliation</h3>
                    <p class="text-gray-600">Espace confidentiel pour le sacrement de réconciliation</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-white rounded-xl shadow-xl p-8 text-center mb-8">
            <h2 class="text-3xl font-bold mb-6 text-purple-900">Prêt à commencer ?</h2>
            <p class="text-gray-600 mb-8 text-lg">Nos guides spirituels sont là pour vous accompagner dans votre cheminement</p>
            
            @if($consultations->isEmpty())
                <a href="{{ route('consultations.create') }}" 
                    class="inline-flex items-center px-8 py-3 border border-transparent rounded-full text-lg font-medium text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg">
                    Prendre rendez-vous
                </a>
            @else
                <div class="space-y-4">
                    <h3 class="font-semibold text-xl text-purple-900">Vos consultations programmées</h3>
                    <div class="divide-y divide-gray-200">
                        @foreach($consultations as $consultation)
                            <div class="py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $consultation->scheduled_at->format('d/m/Y à H:i') }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Type: {{ ucfirst($consultation->type) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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
                                            class="text-sm font-medium text-purple-700 hover:text-purple-600">
                                            Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Testimonials/Reassurance -->
        <div class="bg-white rounded-xl shadow-xl p-8 mb-8">
            <h2 class="text-3xl font-bold mb-8 text-center text-purple-900">Notre Engagement</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="text-center">
                    <div class="rounded-full bg-green-100 w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-xl mb-3 text-purple-900">Confidentialité Absolue</h3>
                    <p class="text-gray-600">Vos échanges sont protégés et restent strictement confidentiels</p>
                </div>
                <div class="text-center">
                    <div class="rounded-full bg-blue-100 w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-xl mb-3 text-purple-900">Accompagnement Bienveillant</h3>
                    <p class="text-gray-600">Une écoute attentive et un soutien spirituel adapté à vos besoins</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection