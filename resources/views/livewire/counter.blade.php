<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-8">
    <div class="container mx-auto max-w-4xl">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-serif text-gray-800 mb-4">Exercice Spirituel</h1>
            <p class="text-gray-600">Méditation et réflexion quotidienne</p>
        </div>

        <!-- Grille de boutons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- Péchés -->
            <button 
                wire:click="tirer('sins')"
                class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300"
                x-data
                x-on:click="$dispatch('element-tire')"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-red-600/10 transform group-hover:scale-105 transition-transform duration-300"></div>
                <div class="relative p-6 text-center">
                    <div class="text-red-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Péchés</h3>
                    <p class="text-sm text-gray-600">Examiner sa conscience</p>
                </div>
            </button>

            <!-- Vertus -->
            <button 
                wire:click="tirer('virtues')"
                class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300"
                x-data
                x-on:click="$dispatch('element-tire')"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-blue-600/10 transform group-hover:scale-105 transition-transform duration-300"></div>
                <div class="relative p-6 text-center">
                    <div class="text-blue-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Vertus</h3>
                    <p class="text-sm text-gray-600">Cultiver la bonté</p>
                </div>
            </button>

            <!-- Dons -->
            <button 
                wire:click="tirer('gifts')"
                class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300"
                x-data
                x-on:click="$dispatch('element-tire')"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-green-600/10 transform group-hover:scale-105 transition-transform duration-300"></div>
                <div class="relative p-6 text-center">
                    <div class="text-green-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Dons de l'Esprit</h3>
                    <p class="text-sm text-gray-600">Recevoir la grâce</p>
                </div>
            </button>

            <!-- Fruits -->
            <button 
                wire:click="tirer('fruits')"
                class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300"
                x-data
                x-on:click="$dispatch('element-tire')"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-purple-600/10 transform group-hover:scale-105 transition-transform duration-300"></div>
                <div class="relative p-6 text-center">
                    <div class="text-purple-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Fruits de l'Esprit</h3>
                    <p class="text-sm text-gray-600">Manifester l'amour</p>
                </div>
            </button>
        </div>

        <!-- Notification -->
        <div 
            x-data="{ show: false }"
            x-on:element-tire.window="show = true; setTimeout(() => { show = false }, 3000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="fixed bottom-4 right-4 bg-white px-6 py-3 rounded-lg shadow-lg text-gray-700 border-l-4 border-green-500"
        >
            <div class="flex items-center space-x-2">
                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Élément tiré avec succès</span>
            </div>
        </div>

        <!-- Résultat -->
        @if($elementTire)
        <div 
            class="bg-white rounded-xl shadow-lg p-8 transform transition-all duration-300"
            x-data
            x-init="$el.style.opacity = 0; setTimeout(() => { $el.style.opacity = 1 }, 50)"
        >
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-serif text-gray-800 mb-6 text-center">
                    {{ ucfirst($type) }}
                </h2>
                <div class="text-xl text-center font-medium text-gray-700 mb-4">{{ $elementTire->nom }}</div>
                @if($elementTire->description)
                    <p class="text-gray-600 text-center leading-relaxed">{{ $elementTire->description }}</p>
                @endif
                <div class="mt-6 text-center">
                    <div class="inline-block px-4 py-2 bg-gray-50 rounded-full text-sm text-gray-500">
                        Prenez un moment pour méditer sur ce message
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>