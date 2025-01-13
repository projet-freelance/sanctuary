<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sky-100 to-white flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-center">
            <!-- Logo Église -->
            <div class="mb-6 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                Espace Membres
            </h2>
            <p class="text-gray-600 mb-6">
                Connectez-vous pour accéder à votre compte
            </p>

            <!-- Gestion des erreurs -->
            <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />
            <x-auth-validation-errors class="mb-4 text-center text-red-600" :errors="$errors" />

            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Champ Email -->
                <div>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        required 
                        autofocus 
                        placeholder="Adresse email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition duration-300"
                    />
                </div>

                <!-- Champ Mot de passe -->
                <div>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Mot de passe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition duration-300"
                    />
                </div>

                <!-- Options de connexion -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a 
                            href="{{ route('password.request') }}" 
                            class="text-sm text-blue-700 hover:text-blue-900"
                        >
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Bouton de connexion -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-blue-700 text-white py-3 rounded-lg hover:bg-blue-800 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        Se connecter
                    </button>
                </div>

                <!-- Lien d'inscription -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Pas encore inscrit ? 
                        <a 
                            href="{{ route('register') }}" 
                            class="font-medium text-blue-700 hover:text-blue-900"
                        >
                            Créer un compte
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection