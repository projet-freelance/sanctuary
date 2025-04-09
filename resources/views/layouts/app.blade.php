<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'E-SANCTUARY') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    <style>
        /* Styles personnalisés pour la navigation */
        .nav-link-custom {
            transition: all 0.3s ease;
            position: relative;
            border-radius: 0.375rem;
        }
        
        .nav-link-custom:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link-custom:hover:after {
            width: 70%;
        }
        
        .dropdown-menu-custom {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            min-width: 12rem;
            padding: 0.5rem 0;
            transform: translateY(10px);
            transition: all 0.2s ease;
        }
        
        .dropdown-item-custom {
            transition: all 0.2s ease;
            padding: 0.6rem 1rem;
            border-left: 3px solid transparent;
        }
        
        .dropdown-item-custom:hover {
            background-color: #f3f4f6;
            border-left: 3px solid #4f46e5;
        }
        
        .user-avatar {
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }
        
        .mobile-menu-container {
            transform-origin: top;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-item {
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .mobile-menu-item:hover {
            border-left: 3px solid #4f46e5;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .logo-container {
            transition: all 0.3s ease;
        }
        
        .logo-container:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <nav x-data="{ mobileOpen: false }" class="bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg border-b border-gray-700">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex-shrink-0 logo-container">
                            <img src="{{ asset('images/LogoeSanctuary.png') }}" alt="Logo" class="h-16 w-auto">
                        </a>

                        <!-- Navigation Desktop -->
                        <div class="hidden lg:ml-10 lg:block">
                            <div class="flex space-x-2">
                                @guest
                                    <a href="{{ url('/') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-home mr-2"></i>Accueil
                                    </a>
                                    <a href="{{ route('about') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>À propos
                                    </a>
                                @endguest

                                @auth
                                    <a href="{{ route('dashboard') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                    </a>

                                    <!-- Menu Spiritualité -->
                                    <div class="relative group" x-data="{ open: false }">
                                        <button 
                                            @click="open = !open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                            <i class="fas fa-church mr-2"></i>
                                            Spiritualité
                                            <svg class="ml-2 h-4 w-4 transition-transform" 
                                                :class="{'rotate-180': open}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div 
                                            x-show="open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="absolute left-0 mt-2 w-56 origin-top-left dropdown-menu-custom bg-white z-20">
                                            <a href="{{ route('bible.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-book mr-3 text-indigo-500"></i>Bible
                                            </a>
                                            <a href="{{ route('prayers.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-pray mr-3 text-indigo-500"></i>Prières
                                            </a>
                                            <a href="{{ route('quote.random') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-quote-right mr-3 text-indigo-500"></i>Citations
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Menu Enseignement -->
                                    <div class="relative group" x-data="{ open: false }">
                                        <button 
                                            @click="open = !open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                            <i class="fas fa-graduation-cap mr-2"></i>
                                            Enseignement
                                            <svg class="ml-2 h-4 w-4 transition-transform" 
                                                :class="{'rotate-180': open}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div 
                                            x-show="open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="absolute left-0 mt-2 w-56 origin-top-left dropdown-menu-custom bg-white z-20">
                                            <a href="{{ route('teachings.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-chalkboard-teacher mr-3 text-indigo-500"></i>Enseignements
                                            </a>
                                            <a href="{{ route('biblevideos.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-video mr-3 text-indigo-500"></i>Vidéos
                                            </a>
                                            <a href="{{ route('consultations.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-comments mr-3 text-indigo-500"></i>Chat direct
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Menu Partenaire -->
                                    <div class="relative group" x-data="{ open: false }">
                                        <button 
                                            @click="open = !open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                            <i class="fas fa-handshake mr-2"></i>
                                            Partenaire
                                            <svg class="ml-2 h-4 w-4 transition-transform" 
                                                :class="{'rotate-180': open}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div 
                                            x-show="open" 
                                            @mouseover="open = true" 
                                            @mouseleave="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="absolute left-0 mt-2 w-56 origin-top-left dropdown-menu-custom bg-white z-20">
                                            <a href="{{ route('radios.index') }}" class="dropdown-item-custom flex items-center text-gray-700 hover:text-gray-900">
                                                <i class="fas fa-broadcast-tower mr-3 text-indigo-500"></i>Radios
                                            </a>
                                        </div>
                                    </div>

                                    <a href="{{ route('testimonies.index') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-comment-dots mr-2"></i>Témoignages
                                    </a>
                                    <a href="{{ route('products.index') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-shopping-cart mr-2"></i>Produits
                                    </a>
                                    <a href="{{ route('events.index') }}" class="nav-link-custom text-gray-200 hover:bg-gray-700 hover:text-white px-4 py-3 rounded-md text-sm font-medium flex items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>Event
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Menu utilisateur -->
@auth
<div class="hidden lg:flex lg:items-center lg:ml-10">
    <div class="relative" x-data="{ userMenuOpen: false }">
        <button 
            @click="userMenuOpen = !userMenuOpen" 
            type="button"
            class="flex items-center text-xs focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <span class="sr-only">Menu utilisateur</span>
            <div class="h-8 w-8 rounded-full user-avatar bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-sm border border-gray-700">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <span class="ml-1 text-white font-medium hidden lg:block">{{ Auth::user()->name }}</span>
            <svg class="ml-1 h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        
        <div 
            x-cloak
            x-show="userMenuOpen" 
            @click.outside="userMenuOpen = false"
            class="absolute right-0 mt-1 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
            <div class="py-1">
                <div class="px-3 py-2">
                    <p class="text-xs font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</p>
                </div>
                <div class="border-t border-gray-100"></div>
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <i class="fas fa-user-circle mr-2 text-indigo-500"></i>Profil
                </a>
                <div class="border-t border-gray-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <i class="fas fa-sign-out-alt mr-2 text-indigo-500"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth


   

                  

                    <!-- Bouton mobile -->
                    <div class="lg:hidden">
                        <button 
                            @click="mobileOpen = !mobileOpen" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Menu principal</span>
                            <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
            <div 
                x-show="mobileOpen" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="lg:hidden mobile-menu-container bg-gray-800">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @guest
                        <a href="{{ url('/') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-home mr-2 w-6 text-center"></i>Accueil
                        </a>
                        <a href="{{ route('about') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-info-circle mr-2 w-6 text-center"></i>À propos
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-tachometer-alt mr-2 w-6 text-center"></i>Dashboard
                        </a>

                        <!-- Mobile User Information -->
                        <div class="py-2 px-3 mb-2 mt-2 bg-gray-700 rounded-md">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white border-2 border-gray-600">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-xs text-gray-300 hover:text-white">Voir profil</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Spiritualité -->
                        <div x-data="{ spiritualiteOpen: false }">
                            <button 
                                @click="spiritualiteOpen = !spiritualiteOpen"
                                class="mobile-menu-item w-full flex justify-between items-center text-gray-200 hover:text-white px-3 py-2 rounded-md text-base font-medium">
                                <span><i class="fas fa-church mr-2 w-6 text-center"></i>Spiritualité</span>
                                <svg class="h-5 w-5 transition-transform" :class="{'rotate-180': spiritualiteOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div 
                                x-show="spiritualiteOpen" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="pl-6 bg-gray-900 rounded-md mt-1 mb-1">
                                <a href="{{ route('bible.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-book mr-2 w-6 text-center"></i>Bible
                                </a>
                                <a href="{{ route('prayers.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-pray mr-2 w-6 text-center"></i>Prières
                                </a>
                                <a href="{{ route('quote.random') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-quote-right mr-2 w-6 text-center"></i>Citations
                                </a>
                            </div>
                        </div>
                        
                        <!-- Mobile Enseignement -->
                        <div x-data="{ enseignementOpen: false }">
                            <button 
                                @click="enseignementOpen = !enseignementOpen"
                                class="mobile-menu-item w-full flex justify-between items-center text-gray-200 hover:text-white px-3 py-2 rounded-md text-base font-medium">
                                <span><i class="fas fa-graduation-cap mr-2 w-6 text-center"></i>Enseignement</span>
                                <svg class="h-5 w-5 transition-transform" :class="{'rotate-180': enseignementOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div 
                                x-show="enseignementOpen" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="pl-6 bg-gray-900 rounded-md mt-1 mb-1">
                                <a href="{{ route('teachings.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-chalkboard-teacher mr-2 w-6 text-center"></i>Enseignements
                                </a>
                                <a href="{{ route('biblevideos.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-video mr-2 w-6 text-center"></i>Vidéos
                                </a>
                                <a href="{{ route('consultations.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-comments mr-2 w-6 text-center"></i>Chat direct
                                </a>
                            </div>
                        </div>

                        <!-- Mobile Partenaire -->
                        <div x-data="{ partenairesOpen: false }">
                            <button 
                                @click="partenairesOpen = !partenairesOpen"
                                class="mobile-menu-item w-full flex justify-between items-center text-gray-200 hover:text-white px-3 py-2 rounded-md text-base font-medium">
                                <span><i class="fas fa-handshake mr-2 w-6 text-center"></i>Partenaire</span>
                                <svg class="h-5 w-5 transition-transform" :class="{'rotate-180': partenairesOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div 
                                x-show="partenairesOpen" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="pl-6 bg-gray-900 rounded-md mt-1 mb-1">
                                <a href="{{ route('radios.index') }}" class="mobile-menu-item block px-3 py-2 text-gray-300 hover:text-white">
                                    <i class="fas fa-broadcast-tower mr-2 w-6 text-center"></i>Radios
                                </a>
                            </div>
                        </div>

                        <!-- Autres menus mobiles -->
                        <a href="{{ route('testimonies.index') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-comment-dots mr-2 w-6 text-center"></i>Témoignages
                        </a>
                        <a href="{{ route('products.index') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-shopping-cart mr-2 w-6 text-center"></i>Produits
                        </a>
                        <a href="{{ route('events.index') }}" class="mobile-menu-item text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-calendar-alt mr-2 w-6 text-center"></i>Event
                        </a>
                        
                        <!-- Bouton de déconnexion mobile -->
                        <div class="border-t border-gray-700 mt-3 pt-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="mobile-menu-item w-full text-left text-gray-200 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                                <i class="fas fa-sign-out-alt mr-2 w-6 text-center"></i>Déconnexion
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-gray-300 shadow-inner">
            <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Logo et info -->
                    <div class="flex flex-col items-center md:items-start">
                        <img src="{{ asset('images/LogoeSanctuary.png') }}" alt="Logo" class="h-12 w-auto mb-4">
                        <p class="text-sm text-gray-400 text-center md:text-left">
                            E-SANCTUARY est votre sanctuaire en ligne pour la spiritualité chrétienne, offrant des ressources, enseignements et un espace communautaire.
                        </p>
                    </div>
                    
                    <!-- Liens utiles -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-lg font-semibold text-white mb-4">Liens utiles</h3>
                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors duration-300">
                                À propos
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                Confidentialité
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                Conditions d'utilisation
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                Contact
                            </a>
                        </div>
                    </div>
                    
                    <!-- Réseaux sociaux -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-lg font-semibold text-white mb-4">Suivez-nous</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-400">Abonnez-vous à notre newsletter</p>
                            <div class="mt-2 flex">
                                <input type="email" placeholder="Votre email" class="px-3 py-2 text-sm text-gray-900 bg-white rounded-l-md focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 text-sm rounded-r-md transition-colors duration-300">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'E-SANCTUARY') }}. Tous droits réservés.</p>
                    <div class="mt-4 md:mt-0">
                        <p class="text-sm text-gray-400">Fait avec <i class="fas fa-heart text-red-500"></i> pour la communauté chrétienne</p>
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
    <script>
    document.addEventListener('alpine:init', () => {
        // Gestionnaire de scroll pour l'animation de la barre de navigation
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 10) {
                nav.classList.add('bg-gray-900');
                nav.classList.remove('bg-gradient-to-r', 'from-gray-900', 'to-gray-800');
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('bg-gray-900');
                nav.classList.add('bg-gradient-to-r', 'from-gray-900', 'to-gray-800');
                nav.classList.remove('shadow-md');
            }
        });

        // Animation pour les menus déroulants au survol
        Alpine.data('dropdown', () => ({
            open: false,
            toggle() {
                this.open = !this.open;
            },
            enter() {
                this.open = true;
            },
            leave() {
                this.open = false;
            }
        }));
    });
    </script>
</body>
</html>