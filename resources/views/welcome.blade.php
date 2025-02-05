@extends('layouts.app')

<style>
/* Variables CSS */

.transition-transform {
        transition-property: transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Animation pour le survol des publicités */
    .bg-white:hover {
        transform: scale(1.02);
        transition: transform 0.3s ease;
    }


:root {
    --primary: #6B46C1;
    --primary-dark: #553C9A;
    --primary-light: #9F7AEA;
    --transition-fast: 0.3s;
    --transition-slow: 0.6s;
    --bounce: cubic-bezier(0.4, 0, 0.2, 1.5);
}

/* Animations de base améliorées */
.transition-all {
    transition: all var(--transition-fast) var(--bounce);
}

/* Animations des cartes améliorées */
.grid > div {
    transition: transform var(--transition-fast) var(--bounce),
                box-shadow var(--transition-fast) ease,
                opacity var(--transition-slow) ease;
    will-change: transform, box-shadow, opacity;
    transform-origin: center center;
}

.grid > div:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Animations des icônes améliorées */
.fas {
    transition: all var(--transition-fast) var(--bounce);
    will-change: transform, color;
}

.grid > div:hover .fas {
    transform: scale(1.2) rotate(8deg);
    color: var(--primary-light);
}

/* Effet de parallaxe optimisé */
.parallax {
    transform: translateZ(0);
    backface-visibility: hidden;
    perspective: 1000px;
}

/* Animations de texte */
.text-gradient {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: gradient 8s ease infinite;
    background-size: 200% 200%;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Animation du hero */
.hero-content {
    animation: heroFadeIn 1.2s var(--bounce) forwards;
}

@keyframes heroFadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Effet de hover sur les boutons */
.button-hover {
    transition: all var(--transition-fast) var(--bounce);
    position: relative;
    overflow: hidden;
}

.button-hover::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 300%;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
    transform: translate(-50%, -50%) scale(0);
    transition: transform var(--transition-fast) ease-out;
}

.button-hover:hover::after {
    transform: translate(-50%, -50%) scale(1);
}

/* Animations des sections */
.section-fade {
    opacity: 0;
    transform: translateY(30px);
    transition: all var(--transition-slow) ease-out;
}

.section-fade.visible {
    opacity: 1;
    transform: translateY(0);
}

</style>

@section('content')
    <!-- Hero Section -->

    <!-- Carrousel vertical -->

   
    <livewire:horizon />

    <section class="bg-cover bg-center h-screen relative" style="background-image: url('{{ asset('images/prayer.jpg') }}');">
    <div class="absolute inset-0 bg-purple-900/60"></div>

    <!-- Composant Livewire des publicités -->
    <livewire:vertical />

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
            @php
                $services = [
                    ['icon' => 'fas fa-bible', 'title' => 'Versets Bibliques', 'description' => 'Texte et audio disponibles', 'route' => 'versets'],
                    ['icon' => 'fas fa-heart', 'title' => 'Témoignages', 'description' => 'Partagez votre histoire', 'route' => 'temoignages'],
                    ['icon' => 'fas fa-pray', 'title' => 'Intention de prière', 'description' => 'SMS ou note vocale', 'route' => 'prieres'],
                    ['icon' => 'fas fa-brain', 'title' => 'Exercice spirituel', 'description' => 'Vertus et dons de l\'Esprit', 'route' => 'exercices'],
                    ['icon' => 'fas fa-angel', 'title' => 'Saint intercesseur', 'description' => 'Découvrez votre saint protecteur', 'route' => 'saint'],
                    ['icon' => 'fas fa-store', 'title' => 'Store', 'description' => 'Objets de piété et plus', 'route' => 'store'],
                ];
            @endphp

            @foreach ($services as $service)
                <a href="{{ auth()->check() ? route($service['route']) : route('login') }}" class="block">
                    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <i class="{{ $service['icon'] }} text-purple-600 text-2xl"></i>
                                <h3 class="text-xl font-semibold text-purple-800">{{ $service['title'] }}</h3>
                            </div>
                            <p class="text-blue-600">{{ $service['description'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Carrousel vertical -->
<livewire:vertical />

<!-- Features Highlight -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $features = [
                    ['image' => 'bible.jpg', 'title' => 'Contenu Biblique', 'description' => 'Accédez à des versets et histoires bibliques', 'route' => 'versets'],
                    ['image' => 'prayer1.jpg', 'title' => 'Prières', 'description' => 'Partagez vos intentions de prière', 'route' => 'prieres'],
                    ['image' => 'jesus.jpg', 'title' => 'Enseignements', 'description' => 'Découvrez nos ressources spirituelles', 'route' => 'enseignements'],
                ];
            @endphp

            @foreach ($features as $feature)
                <a href="{{ auth()->check() ? route($feature['route']) : route('login') }}" class="block">
                    <div class="bg-cover bg-center rounded-lg overflow-hidden relative h-64" style="background-image: url('{{ asset('images/' . $feature['image']) }}');">
                        <div class="absolute inset-0 bg-purple-900/50"></div>
                        <div class="relative h-full flex items-center justify-center text-center p-6">
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $feature['title'] }}</h3>
                                <p class="text-white">{{ $feature['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
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

 <script>
    // Animation pour la section hero avec effet de fade-in
document.addEventListener('DOMContentLoaded', () => {
    // Animer le hero section au chargement
    const heroContent = document.querySelector('.text-center.text-white');
    if (heroContent) {
        heroContent.style.opacity = '0';
        heroContent.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            heroContent.style.transition = 'opacity 1s ease-out, transform 1s ease-out';
            heroContent.style.opacity = '1';
            heroContent.style.transform = 'translateY(0)';
        }, 300);
    }

    // Animation des cartes de services au scroll
    const serviceCards = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3 > div');
    
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px'
    };

    const cardObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease-out';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.opacity = '1';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    serviceCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        cardObserver.observe(card);
    });

    // Animation hover pour les cartes de services
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px) scale(1.02)';
            const icon = card.querySelector('.fas');
            if (icon) {
                icon.style.transform = 'scale(1.2) rotate(5deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
            const icon = card.querySelector('.fas');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0)';
            }
        });
    });

    // Animation pour les cartes de features
    const featureCards = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-3 > div');
    
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            const overlay = card.querySelector('.bg-purple-900\\/50');
            if (overlay) {
                overlay.style.transition = 'background-color 0.3s ease';
                overlay.style.backgroundColor = 'rgba(88, 28, 135, 0.7)';
            }
            
            const content = card.querySelector('.relative.h-full');
            if (content) {
                content.style.transform = 'scale(1.05)';
                content.style.transition = 'transform 0.3s ease';
            }
        });

        card.addEventListener('mouseleave', () => {
            const overlay = card.querySelector('.bg-purple-900\\/50');
            if (overlay) {
                overlay.style.backgroundColor = 'rgba(88, 28, 135, 0.5)';
            }
            
            const content = card.querySelector('.relative.h-full');
            if (content) {
                content.style.transform = 'scale(1)';
            }
        });
    });

    // Animation pour le bouton "Rejoignez-nous"
    const joinButton = document.querySelector('a[href="/login"]');
    if (joinButton) {
        joinButton.addEventListener('mouseenter', () => {
            joinButton.style.transform = 'scale(1.05)';
            joinButton.style.boxShadow = '0 4px 15px rgba(37, 99, 235, 0.3)';
            joinButton.style.transition = 'all 0.3s ease';
        });

        joinButton.addEventListener('mouseleave', () => {
            joinButton.style.transform = 'scale(1)';
            joinButton.style.boxShadow = 'none';
        });
    }

    // Animation pour la section témoignages
    const testimonialSection = document.querySelector('section.bg-purple-800');
    if (testimonialSection) {
        const testimonialObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const content = entry.target.querySelector('.container');
                    if (content) {
                        content.style.transition = 'all 0.8s ease-out';
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0)';
                    }
                }
            });
        }, { threshold: 0.3 });

        testimonialSection.querySelector('.container').style.opacity = '0';
        testimonialSection.querySelector('.container').style.transform = 'translateY(30px)';
        testimonialObserver.observe(testimonialSection);
    }

    // Animation de parallaxe pour l'arrière-plan du hero
    window.addEventListener('scroll', () => {
        const heroSection = document.querySelector('section.bg-cover.bg-center.h-screen');
        if (heroSection) {
            const scrolled = window.pageYOffset;
            heroSection.style.backgroundPositionY = `${scrolled * 0.5}px`;
        }
    });
});
 </script>   
@endsection