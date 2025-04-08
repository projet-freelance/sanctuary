@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-serif text-indigo-900 mb-4" id="main-title">Espace de Prières</h1>
        <p class="text-gray-600">Un lieu de recueillement et de partage spirituel</p>
    </div>

    <div class="max-w-4xl mx-auto" id="prayers-container">
        @foreach ($prayers as $prayer)
        <div class="bg-white rounded-lg shadow-xl mb-6 overflow-hidden prayer-card">
            <div class="bg-indigo-900 text-white p-4">
                <h2 class="text-2xl font-serif">{{ $prayer->title }}</h2>
            </div>
            
            <div class="p-6">
    <div class="flex justify-between items-center">
        <div class="text-gray-600">
            <i class="fas fa-user mr-2"></i>
            {{ fakePrayerName($prayer->user->id) }}
        </div>
        <a href="{{ route('prayers.show', $prayer) }}" 
           class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
            <i class="fas fa-pray mr-2"></i>
            Méditer
        </a>
    </div>
</div>

        </div>
        @endforeach
    </div>

    <div class="text-center mt-12">
        <a href="{{ route('prayers.create') }}" 
           class="inline-flex items-center bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition-colors" id="share-button">
            <i class="fas fa-plus-circle mr-2"></i>
            Partager une Prière
        </a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    // Animation principale
    document.addEventListener("DOMContentLoaded", () => {
        // Animation du titre principal
        gsap.from("#main-title", { 
            opacity: 0, 
            y: -50, 
            duration: 1, 
            ease: "power2.out" 
        });

        // Animation des cartes de prière
        gsap.from(".prayer-card", { 
            opacity: 0, 
            y: 50, 
            duration: 0.8, 
            ease: "power2.out", 
            stagger: 0.3 
        });

        // Animation du bouton "Partager une Prière"
        gsap.from("#share-button", { 
            opacity: 0, 
            scale: 0.8, 
            duration: 0.8, 
            ease: "back.out(1.5)", 
            delay: 0.5 
        });
    });
</script>
@endsection
