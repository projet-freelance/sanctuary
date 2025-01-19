@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen relative" style="background-image: url('{{ asset('images/prayer.jpg') }}');">
        <div class="absolute inset-0 bg-purple-900/60"></div>
        <div class="relative flex items-center justify-center h-full">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4">Bienvenue sur E-sanctuary</h1>
                <p class="text-xl mb-8">Explorez les enseignements bibliques, partagez vos prières et témoignages, et grandissez spirituellement.</p>
                <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-8 rounded-full text-lg transition duration-300">
                    Rejoignez-nous
                </a>
            </div>
        </div>
    </section>

    <!-- Main Features Grid -->
    <section class="py-16 bg-gradient-to-b from-purple-50 to-purple-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-purple-800 text-center mb-12">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Versets Bibliques -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-bible text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Versets Bibliques</h3>
                        </div>
                        <p class="text-blue-600">Texte et audio disponibles</p>
                    </div>
                </div>

                <!-- Témoignages -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-heart text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Témoignages</h3>
                        </div>
                        <p class="text-blue-600">Partagez votre histoire</p>
                    </div>
                </div>

                <!-- Intention de prière -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-pray text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Intention de prière</h3>
                        </div>
                        <p class="text-blue-600">SMS ou note vocale</p>
                    </div>
                </div>

                <!-- Exercice spirituel -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-brain text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Exercice spirituel</h3>
                        </div>
                        <p class="text-blue-600">Vertus et dons de l'Esprit</p>
                    </div>
                </div>

                <!-- Saint intercesseur -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-angel text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Saint intercesseur</h3>
                        </div>
                        <p class="text-blue-600">Découvrez votre saint protecteur</p>
                    </div>
                </div>

                <!-- Boutique -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <i class="fas fa-store text-purple-600 text-2xl"></i>
                            <h3 class="text-xl font-semibold text-purple-800">Store</h3>
                        </div>
                        <p class="text-blue-600">Objets de piété et plus</p>
                    </div>
                </div>

                <!-- Autres cartes similaires... -->
            </div>
        </div>
    </section>

    <!-- Features Highlight -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-cover bg-center rounded-lg overflow-hidden relative h-64" style="background-image: url('{{ asset('images/bible.jpg') }}');">
                    <div class="absolute inset-0 bg-purple-900/50"></div>
                    <div class="relative h-full flex items-center justify-center text-center p-6">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Contenu Biblique</h3>
                            <p class="text-white">Accédez à des versets et histoires bibliques</p>
                        </div>
                    </div>
                </div>

                <div class="bg-cover bg-center rounded-lg overflow-hidden relative h-64" style="background-image: url('{{ asset('images/prayer1.jpg') }}');">
                    <div class="absolute inset-0 bg-purple-900/50"></div>
                    <div class="relative h-full flex items-center justify-center text-center p-6">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Prières</h3>
                            <p class="text-white">Partagez vos intentions de prière</p>
                        </div>
                    </div>
                </div>

                <div class="bg-cover bg-center rounded-lg overflow-hidden relative h-64" style="background-image: url('{{ asset('images/jesus.jpg') }}');">
                    <div class="absolute inset-0 bg-purple-900/50"></div>
                    <div class="relative h-full flex items-center justify-center text-center p-6">
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Enseignements</h3>
                            <p class="text-white">Découvrez nos ressources spirituelles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-purple-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8 text-white">Témoignages</h2>
            <p class="text-lg mb-8 text-white">Découvrez les récits inspirants de notre communauté</p>
            <a href="/temoignages" class="bg-white text-purple-800 hover:bg-gray-100 py-3 px-8 rounded-full text-lg transition duration-300">
                Voir les témoignages
            </a>
        </div>
    </section>
@endsection