@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-teal-50 to-white flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-lg bg-white shadow-xl rounded-lg border border-gray-100 overflow-hidden p-8">
            <!-- Logo et Titre -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Inscription</h2>
                <p class="text-gray-600 mt-2">Rejoignez notre communauté en quelques étapes</p>
            </div>

            <!-- Erreurs de validation -->
            <x-auth-validation-errors class="mb-6 text-center text-red-600" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <x-label for="name" :value="__('Nom complet')" class="text-sm font-medium text-gray-700" />
                        <x-input 
                            id="name" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            placeholder="Votre nom complet"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" :value="__('Adresse email')" class="text-sm font-medium text-gray-700" />
                        <x-input 
                            id="email" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            placeholder="votre.email@example.com"
                        />
                    </div>
                </div>

                <!-- Numéro de téléphone -->
                <div>
                    <x-label for="phone" :value="__('Numéro de téléphone')" class="text-sm font-medium text-gray-700" />
                    <x-input 
                        id="phone" 
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                        type="tel" 
                        name="phone" 
                        :value="old('phone')" 
                        required 
                        placeholder="+33 6 00 00 00 00"
                    />
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Pays -->
                    <div>
                        <x-label for="country" :value="__('Pays')" class="text-sm font-medium text-gray-700" />
                        <select 
                            id="country" 
                            name="country" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            required
                        >
                            <option value="">Sélectionnez votre pays</option>
                            <option value="FR">France</option>
                            <option value="BE">Belgique</option>
                            <option value="CH">Suisse</option>
                            <!-- Ajoutez d'autres pays -->
                        </select>
                    </div>

                    <!-- Ville -->
                    <div>
                        <x-label for="city" :value="__('Ville')" class="text-sm font-medium text-gray-700" />
                        <x-input 
                            id="city" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            type="text" 
                            name="city" 
                            :value="old('city')" 
                            required 
                            placeholder="Votre ville"
                        />
                    </div>
                </div>

                <!-- Date de Naissance -->
                <div>
                    <x-label for="birthdate" :value="__('Date de naissance')" class="text-sm font-medium text-gray-700" />
                    <x-input 
                        id="birthdate" 
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                        type="date" 
                        name="birthdate" 
                        :value="old('birthdate')" 
                        required 
                    />
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Mot de passe -->
                    <div>
                        <x-label for="password" :value="__('Mot de passe')" class="text-sm font-medium text-gray-700" />
                        <x-input 
                            id="password" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password"
                            placeholder="Mot de passe"
                        />
                    </div>

                    <!-- Confirmation Mot de passe -->
                    <div>
                        <x-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-sm font-medium text-gray-700" />
                        <x-input 
                            id="password_confirmation" 
                            class="block mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            type="password"
                            name="password_confirmation" 
                            required 
                            placeholder="Confirmation"
                        />
                    </div>
                </div>

                <!-- Consentement -->
                <div class="flex items-center space-x-2 mt-4">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required
                    >
                    <span class="text-sm text-gray-600">
                        J'accepte les <a href="#" class="text-indigo-600 hover:text-indigo-800">conditions d'utilisation</a> et la <a href="#" class="text-indigo-600 hover:text-indigo-800">politique de confidentialité</a>
                    </span>
                </div>

                <!-- Bouton d'inscription -->
                <div class="mt-6">
                    <x-button class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        {{ __('S\'inscrire') }}
                    </x-button>
                </div>

                <!-- Lien de connexion -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Déjà inscrit ? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">
                            Connectez-vous
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
