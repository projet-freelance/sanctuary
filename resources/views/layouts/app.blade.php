<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>

<script src="{{ mix('js/app.js') }}" defer></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Stylesheets -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"> <!-- Utilisation de mix() pour les fichiers CSS compilés -->
</head>
<body class="font-sans antialiased bg-blue-500">
    <div class="min-h-screen bg-blue-200">
        <nav x-data="{ open: false }" class="bg-[#5A8AA0] text-white border-b border-blue-200">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ url('/') }}">
                                <x-application-logo class="block h-10 w-auto fill-current text-white" />
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @guest
                                <x-nav-link :href=" url('/') " :active="request()->routeIs('home')" class="text-white hover:text-blue-300">
                                    {{ __('Accueil') }}
                                </x-nav-link>
                                <x-nav-link :href=" route('about') " :active="request()->routeIs('about')" class="text-white hover:text-blue-300">
                                    {{ __('À propos') }}
                                </x-nav-link>
                            @endguest

                            @auth
                                <x-nav-link :href=" url('/') " :active="request()->routeIs('home')" class="text-white hover:text-blue-300">
                                    {{ __('Accueil') }}
                                </x-nav-link>
                                <x-nav-link :href="route('bible.index')" :active="request()->routeIs('bible.index')" class="text-white hover:text-blue-300">
                                    {{ __('Bible') }}
                                </x-nav-link>
                                <x-nav-link :href="route('prayers.index')" :active="request()->routeIs('prayers.index')" class="text-white hover:text-blue-300">
                                    {{ __('Prières') }}
                                </x-nav-link>
                                <x-nav-link :href="route('testimonies.index')" :active="request()->routeIs('testimonies.index')" class="text-white hover:text-blue-300">
                                    {{ __('Témoignages') }}
                                </x-nav-link>
                                <x-nav-link :href="route('aimeos_home')" :active="request()->routeIs('aimeos_home')" class="text-white hover:text-blue-300">
                                    {{ __('Produits') }}
                                </x-nav-link>
                                <x-nav-link :href="route('biblevideos.index')" :active="request()->routeIs('biblevideos.index')" class="text-white hover:text-blue-300">
                                    {{ __('video Histoire') }}
                                </x-nav-link>
                                <x-nav-link :href="route('quote.random')" :active="request()->routeIs('quote.random')" class="text-white hover:text-blue-300">
                                   {{ __('Médite une citation') }}
                                </x-nav-link>
                                <x-nav-link :href="route('teachings.index')" :active="request()->routeIs('teachings.*')" class="text-white hover:text-blue-300">
                                    {{ __('Enseignements') }}
                                </x-nav-link>


                            @endauth
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    @auth
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-white hover:text-blue-300 hover:border-gray-300 focus:outline-none focus:text-blue-300 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Se Déconnecter') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-blue-300 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 focus:text-blue-300 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    @guest
                        <x-responsive-nav-link :href=" url('/') " :active="request()->routeIs('home')" class="text-white hover:text-blue-300">
                            {{ __('Accueil') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href=" route('about') " :active="request()->routeIs('about')" class="text-white hover:text-blue-300">
                            {{ __('À propos') }}
                        </x-responsive-nav-link>
                    @endguest

                    @auth
                        <x-nav-link :href=" url('/') " :active="request()->routeIs('home')" class="text-white hover:text-blue-300">
                            {{ __('Accueil') }}
                        </x-nav-link>
                        <x-nav-link :href="route('prayers.index')" :active="request()->routeIs('prayers.index')" class="text-white hover:text-blue-300">
                            {{ __('Prières') }}
                        </x-nav-link>
                        <x-nav-link :href="route('testimonies.index')" :active="request()->routeIs('testimonies.index')" class="text-white hover:text-blue-300">
                            {{ __('Témoignages') }}
                        </x-nav-link>
                        <x-nav-link :href="route('aimeos_home')" :active="request()->routeIs('aimeos_home')" class="text-white hover:text-blue-300">
                            {{ __('Produits') }}
                        </x-nav-link>
                    @endauth
                </div>

                <div class="pt-4 pb-1 border-t border-blue-700">
                    @auth
                        <div class="px-4">
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Se Déconnecter') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer Section -->
        <footer class="bg-blue-200 text-white py-6 mt-6">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                <div class="mt-4">
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('À propos') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Confidentialité') }}</a>
                    <a href="#" class="text-white hover:text-blue-300 mx-3">{{ __('Conditions d\'utilisation') }}</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script> <!-- Utilisation de mix() pour les fichiers JS compilés -->
</body>
</html>