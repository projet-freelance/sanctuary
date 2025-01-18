<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts
</head>
<body class="font-sans antialiased">
    
    <div class="min-h-screen bg-gray-50">
        <nav x-data="{ open: false }" class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <!-- Mobile menu button -->
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <button @click="open = ! open" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Menu principal</span>
                            <svg :class="{'hidden': open, 'block': ! open }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg :class="{'block': open, 'hidden': ! open }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Logo et Navigation Desktop -->
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex shrink-0 items-center">
                            <a href="{{ url('/') }}">
                                <x-application-logo class="block h-8 w-auto text-white" />
                            </a>
                        </div>

                        <!-- Liens de navigation desktop -->
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                @guest
                                    <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('Accueil') }}</a>
                                    <a href="{{ route('about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('À propos') }}</a>
                                @endguest

                                @auth
                                    <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('Accueil') }}</a>

                                    <!-- Menu "Spiritualité" -->
                                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                                <button @mouseenter="open = true" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">
                                    Spiritualité
                                    <svg class="ml-2 h-4 w-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-0" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-0" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu">
                                    <a href="{{ route('bible.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Bible</a>
                                    <a href="{{ route('prayers.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Prières</a>
                                    <a href="{{ route('quote.random') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Citations</a>
                                </div>
                            </div>

                                    <!-- Menu "Enseignement" -->
                                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                                <button @mouseenter="open = true" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">
                                    Enseignement
                                    <svg class="ml-2 h-4 w-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-0" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-0" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu">
                                    <a href="{{ route('teachings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Enseignements</a>
                                    <a href="{{ route('biblevideos.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Vidéos</a>
                                </div>
                            </div>


                               <!-- Menu "partenair" -->
                               <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                                <button @mouseenter="open = true" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">
                                    partenair
                                    <svg class="ml-2 h-4 w-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-0" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-0" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu">
                                <a href="{{ route('radios.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('Radios') }}</a>
                                </div>
                            </div>

                                    <a href="{{ route('testimonies.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('Témoignages') }}</a>
                                    <a href="{{ route('aimeos_home') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{ __('Produits') }}</a>
                                   
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Menu utilisateur -->
                    @auth
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <div class="relative ml-3" x-data="{ open: false }">
                            <div>
                                <button @click="open = ! open" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="sr-only">Menu utilisateur</span>
                                    <div class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="px-4 py-2 text-sm text-gray-700">{{ Auth::user()->name }}</div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">{{ __('Se Déconnecter') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Menu mobile -->
            <div x-show="open" class="sm:hidden">
                <div class="space-y-1 px-2 pb-3 pt-2">
                    @guest
                        <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{ __('Accueil') }}</a>
                        <a href="{{ route('about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{ __('À propos') }}</a>
                    @endguest

                    @auth
                        <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{ __('Accueil') }}</a>
                        
                        <!-- Mobile menu pour Spiritualité -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-300 hover:bg-gray-700">
                                <span>Spiritualité</span>
                                <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4">
                                <a href="{{ route('bible.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Bible</a>
                                <a href="{{ route('prayers.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Prières</a>
                                <a href="{{ route('quote.random') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Citations</a>
                            </div>
                        </div>
                       

                        <!-- Mobile menu pour Enseignement -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-300 hover:bg-gray-700">
                                <span>Enseignement</span>
                                <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4">
                                <a href="{{ route('teachings.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Bible</a>
                                <a href="{{ route('biblevideos.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Prières</a>
                                
                            </div>
                        </div>

                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-300 hover:bg-gray-700">
                                <span>partenair</span>
                                <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4">
                                <a href="{{ route('radios.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Radios</a>
                                
                            </div>
                        </div>
                       
                    
                        <a href="{{ route('testimonies.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{ __('Témoignages') }}</a>
                        <a href="{{ route('aimeos_home') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{ __('Produits') }}</a>
                   
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
</body>
</html>
