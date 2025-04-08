<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'E-SANCTUARY') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    

    @livewireStyles
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts

</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <nav x-data="{ mobileOpen: false }" class="bg-gray-800 shadow-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0">
                     <img src="{{ asset('images/LogoeSanctuary.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>

                        <!-- Navigation Desktop -->
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                @guest
                                    <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                                        <i class="fas fa-home mr-2"></i>Accueil
                                    </a>
                                    <a href="{{ route('about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                                        <i class="fas fa-info-circle mr-2"></i>À propos
                                    </a>
                                @endguest

                                @auth
                                    <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                                        <i class="fas fa-home mr-2"></i>Accueil
                                    </a>

                                    <!-- Menu Spiritualité -->
                                    <div class="relative group">
                                        <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md flex items-center">
                                            <i class="fas fa-church mr-2"></i>
                                            Spiritualité
                                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div class="absolute hidden group-hover:block bg-white rounded-md shadow-lg py-1 z-20">
                                            <a href="{{ route('bible.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-book mr-2"></i>Bible
                                            </a>
                                            <a href="{{ route('prayers.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-pray mr-2"></i>Prières
                                            </a>
                                            <a href="{{ route('quote.random') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-quote-right mr-2"></i>Citations
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Menu Enseignement -->
                                    <div class="relative group">
                                        <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md flex items-center">
                                            <i class="fas fa-graduation-cap mr-2"></i>
                                            Enseignement
                                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div class="absolute hidden group-hover:block bg-white rounded-md shadow-lg py-1 z-20">
                                            <a href="{{ route('teachings.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-chalkboard-teacher mr-2"></i>Enseignements
                                            </a>
                                            <a href="{{ route('biblevideos.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-video mr-2"></i>Vidéos
                                            </a>
                                            <a href="{{ route('consultations.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-comments mr-2"></i>Chat direct
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Menu Partenaire -->
                                    <div class="relative group">
                                        <button class="text-white hover:bg-gray-700 px-3 py-2 rounded-md flex items-center">
                                            <i class="fas fa-handshake mr-2"></i>
                                            Partenaire
                                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div class="absolute hidden group-hover:block bg-white rounded-md shadow-lg py-1 z-20">
                                            <a href="{{ route('radios.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-broadcast-tower mr-2"></i>Radios
                                            </a>
                                        </div>
                                    </div>

                                    <a href="{{ route('testimonies.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md flex items-center">
                                        <i class="fas fa-comment-dots mr-2"></i>Témoignages
                                    </a>
                                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md flex items-center">
                                        <i class="fas fa-shopping-cart mr-2"></i>Produits
                                    </a>
                                    <a href="{{ route('events.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md flex items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>Event
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Menu utilisateur -->
                    @auth
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex items-center">
                            <div class="relative" x-data="{ userMenuOpen: false }">
                                <button 
                                    @click="userMenuOpen = !userMenuOpen" 
                                    class="bg-gray-800 flex text-sm rounded-full focus:outline-none">
                                    <span class="sr-only">Menu utilisateur</span>
                                    <div class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>
                                
                                <div 
                                    x-show="userMenuOpen" 
                                    @click.away="userMenuOpen = false"
                                    class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                                    <div class="py-1">
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ Auth::user()->name }}
                                   </a>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- Bouton mobile -->
                    <div class="-mr-2 flex sm:hidden">
                        <button 
                            @click="mobileOpen = !mobileOpen" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700">
                            <span class="sr-only">Menu principal</span>
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path 
                                    :class="{'hidden': mobileOpen, 'block': !mobileOpen}"
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2" 
                                    d="M4 6h16M4 12h16M4 18h16" 
                                />
                                <path 
                                    :class="{'block': mobileOpen, 'hidden': !mobileOpen}"
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2" 
                                    d="M6 18L18 6M6 6l12 12" 
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu mobile -->
            <div x-show="mobileOpen" class="sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @guest
                        <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-home mr-2"></i>Accueil
                        </a>
                        <a href="{{ route('about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-info-circle mr-2"></i>À propos
                        </a>
                    @endguest

                    @auth
                        <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-home mr-2"></i>Accueil
                        </a>

                        <!-- Mobile Spiritualité -->
                        <div x-data="{ spiritualiteOpen: false }">
                            <button 
                                @click="spiritualiteOpen = !spiritualiteOpen"
                                class="w-full flex justify-between items-center text-white hover:bg-gray-700 px-3 py-2 rounded-md">
                                <span><i class="fas fa-church mr-2"></i>Spiritualité</span>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="spiritualiteOpen" class="pl-6">
                                <a href="{{ route('bible.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
                                    <i class="fas fa-book mr-2"></i>Bible
                                </a>
                                <a href="{{ route('prayers.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
                                    <i class="fas fa-pray mr-2"></i>Prières
                                </a>
                                <a href="{{ route('quote.random') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
                                    <i class="fas fa-quote-right mr-2"></i>Citations
                                </a>
                            </div>
                        </div>
                        <!-- Mobile Enseignement -->
<div x-data="{ enseignementOpen: false }">
    <button 
        @click="enseignementOpen = !enseignementOpen"
        class="w-full flex justify-between items-center text-white hover:bg-gray-700 px-3 py-2 rounded-md">
        <span><i class="fas fa-graduation-cap mr-2"></i>Enseignement</span>
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="enseignementOpen" class="pl-6">
        <a href="{{ route('teachings.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
            <i class="fas fa-chalkboard-teacher mr-2"></i>Enseignements
        </a>
        <a href="{{ route('biblevideos.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
            <i class="fas fa-video mr-2"></i>Vidéos
        </a>
        <a href="{{ route('consultations.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
            <i class="fas fa-comments mr-2"></i>Chat direct
        </a>
    </div>
</div>

<!-- Mobile Partenaire -->
<div x-data="{ partenairesOpen: false }">
    <button 
        @click="partenairesOpen = !partenairesOpen"
        class="w-full flex justify-between items-center text-white hover:bg-gray-700 px-3 py-2 rounded-md">
        <span><i class="fas fa-handshake mr-2"></i>Partenaire</span>
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="partenairesOpen" class="pl-6">
        <a href="{{ route('radios.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700">
            <i class="fas fa-broadcast-tower mr-2"></i>Radios
        </a>
    </div>
</div>

                        <!-- Autres menus mobiles similaires -->
                        
                        <a href="{{ route('testimonies.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-comment-dots mr-2"></i>Témoignages
                        </a>
                        <a href="{{ route('products.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-shopping-cart mr-2"></i>Produits
                        </a>
                        <a href="{{ route('events.index') }}" class="text-white hover:bg-blue-700 hover:text-white block px-3 py-2 rounded-md">
                            <i class="fas fa-calendar-alt mr-2"></i>Event
                        </a>
                    @endauth
                </div>
            </div>
        </nav>


        <!-- Contenu principal -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
                    <div class="mt-4">
                        <a href="#" class="text-gray-300 hover:text-white mx-3">{{ __('À propos') }}</a>
                        <a href="#" class="text-gray-300 hover:text-white mx-3">{{ __('Confidentialité') }}</a>
                        <a href="#" class="text-gray-300 hover:text-white mx-3">{{ __('Conditions d\'utilisation') }}</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @filamentScripts
     @vite('resources/js/app.js')
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
