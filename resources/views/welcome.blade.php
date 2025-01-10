@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/prayer.jpg') }}');">
        <div class="flex items-center justify-center h-full" style="background-color: rgba(128, 0, 128, 0.6);">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Bienvenue sur E-sanctuary</h2>
                <p class="text-lg mb-6">Explorez les enseignements bibliques, partagez vos prières et témoignages, et connectez-vous spirituellement.</p>
                <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-full">Rejoignez-nous</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16" style="background-image: url('{{ asset('images/jesus.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-8 text-white">Nos Fonctionnalités</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white shadow-md rounded-lg p-6" style="background-image: url('{{ asset('images/bible.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <i class="fas fa-bible text-blue-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2 text-blue-800">Contenu Biblique</h3>
                <p>Accédez à des versets et histoires bibliques en texte et audio.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6" style="background-image: url('{{ asset('images/prayer1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <i class="fas fa-hands text-blue-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2 text-blue-800">Prières</h3>
                <p>Soumettez vos intentions de prière et participez à des exercices spirituels.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6" style="background-image: url('{{ asset('images/jesus.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <i class="fas fa-store text-blue-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2 text-blue-800">Boutique</h3>
                <p>Achetez des objets religieux et soutenez votre foi.</p>
            </div>
        </div>
    </div>
</section>

    <!-- Testimonials Section -->
    <section class="py-16" style="background-color: #800080;"> <!-- Violet -->
        <div class="container mx-auto px-6 text-center text-white">
            <h2 class="text-3xl font-bold mb-8">Témoignages</h2>
            <p class="mb-6">Découvrez les récits inspirants de notre communauté.</p>
            <a href="/temoignages" class="bg-white text-purple-700 py-2 px-6 rounded-full" style="color: #800080;">Voir les témoignages</a>
        </div>
    </section>
@endsection
