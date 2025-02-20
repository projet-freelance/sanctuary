@extends('layouts.app')

@section('title', 'À Propos - E-Sanctuary')

@section('styles')
<style>
    .about-header {
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        color: white;
        padding: 6rem 2rem;
        text-align: center;
    }

    .content-section {
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }
</style>
@endsection

@section('content')
<div class="about-header">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">E-SANCTUARY</h1>
        <p class="text-lg md:text-xl text-blue-100">Votre sanctuaire virtuel pour une foi vivante</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="content-section max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 text-center md:text-left">AVANT-PROPOS</h2>

        <div class="mt-6 text-gray-700 space-y-4">
            <p>
                Bienvenue sur <span class="font-semibold text-blue-600">E-SANCTUARY</span>, 
                un sanctuaire virtuel dédié à guider ceux qui cherchent à approfondir leur marche avec Dieu.
            </p>

            <p>
                Nous croyons que chaque individu est appelé à une relation intime et unique avec 
                <span class="font-bold">DIEU</span>. À travers nos services et conseils, nous offrons 
                les outils nécessaires pour une foi chrétienne authentique et épanouissante.
            </p>

            <p>
                Que vous soyez au début de votre cheminement spirituel ou en quête d’un approfondissement, 
                <span class="font-semibold text-blue-600">E-SANCTUARY</span> vous accompagne à chaque étape.
            </p>
        </div>

        <div class="mt-8 bg-gray-50 p-6 rounded-lg">
            <h3 class="text-xl font-semibold mb-4">Nos Services</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Consultations spirituelles</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Méditations quotidiennes</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Pioche de pain de vie</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Témoignages inspirants</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Conférences en ligne</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Enseignement spirituel</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 p-6 bg-blue-100 text-gray-800 rounded-lg text-center">
        <p class="text-lg font-semibold">
            "Notre vision est de créer un espace où chacun peut se sentir accueilli, écouté et soutenu. 
            Un espace où la foi devient une force vivante et dynamique."
        </p>
    </div>

    <section class="mt-16">
        <h2 class="text-3xl font-bold text-center text-gray-800">Notre Équipe</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="team-card bg-white rounded-lg overflow-hidden shadow-lg p-6 text-center">
                <img src="{{ asset('images/team/dev2.jpg') }}" alt="Marie Dupont" class="w-32 h-32 mx-auto rounded-full">
                <h3 class="text-xl font-semibold mt-4">Marie Dupont</h3>
                <p class="text-gray-600">UI/UX Designer</p>
                <p class="mt-2 text-gray-600">Spécialiste en conception d'interfaces ergonomiques</p>
            </div>
        </div>
    </section>
</div>
@endsection
