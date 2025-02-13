@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-tr from-indigo-100 via-purple-100 to-pink-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <!-- Header Section -->
            <div class="px-8 pt-8 pb-6 text-center">
                <div class="relative mx-auto w-20 h-20 mb-6">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl transform rotate-6 transition-transform group-hover:rotate-12"></div>
                    <div class="relative bg-white rounded-xl p-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-600">Inscription</h2>
                <p class="mt-2 text-gray-600">Rejoignez notre communauté en quelques étapes</p>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-6 px-8 text-center text-red-600" :errors="$errors" />

            <!-- Form Section -->
            <form method="POST" action="{{ route('register') }}" class="px-8 pb-8 space-y-6" onsubmit="return validateCountrySelection()">
                @csrf
                
                <!-- Two Columns Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="group">
                        <x-label for="name" :value="__('Nom complet')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-input id="name" type="text" name="name" :value="old('name')" required autofocus 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                        </div>
                    </div>

                    <div class="group">
                        <x-label for="email" :value="__('Adresse email')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-input id="email" type="email" name="email" :value="old('email')" required 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                        </div>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="group">
                    <x-label for="phone" :value="__('Numéro de téléphone')" class="text-gray-700 font-medium" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <x-input id="phone" type="tel" name="phone" :value="old('phone')" required 
                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                    </div>
                </div>

                <!-- Country and City -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="group">
                        <x-label for="country" :value="__('Pays')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <select id="country" name="country" required 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200">
                            </select>
                        </div>
                    </div>

                    <div class="group">
                        <x-label for="city" :value="__('Ville')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <x-input id="city" type="text" name="city" :value="old('city')" required 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                        </div>
                    </div>
                </div>

               <!-- Birthdate -->
<div class="group">
    <x-label for="birthdate" :value="__('Date de naissance')" class="text-gray-700 font-medium" />
    
    <div class="mt-1 relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        
        <x-input id="birthdate" type="date" name="birthdate"
            value="{{ old('birthdate') ? \Carbon\Carbon::parse(old('birthdate'))->format('Y-m-d') : '' }}" 
            class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" 
            required />
    </div>
</div>


                <!-- Password Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="group">
                        <x-label for="password" :value="__('Mot de passe')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-input id="password" type="password" name="password" required 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                        </div>
                    </div>

                    <div class="group">
                        <x-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-input id="password_confirmation" type="password" name="password_confirmation" required 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-200" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
<div class="mt-8">
    <button type="submit" class="w-full flex items-center justify-center py-3 px-6 border border-transparent rounded-lg shadow-lg text-base font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
        <span>{{ __('S\'inscrire') }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
            </form>
        </div>
    </div>

    <!-- Modal d'avertissement -->
    <div id="warningModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p id="warningMessage" class="text-red-600 font-bold"></p>
            <button onclick="closeWarningModal()" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">OK</button>
        </div>
    </div>

    <script>
        let detectedCountry = null;

        async function verifyIPCountry() {
            try {
                const ipResponse = await fetch('https://ipapi.co/json/');
                const ipData = await ipResponse.json();
                detectedCountry = ipData.country_name;
                return detectedCountry;
            } catch (error) {
                console.error('Erreur de géolocalisation IP:', error);
                return null;
            }
        }

        function showWarningModal(selectedCountry) {
            document.getElementById('warningMessage').textContent = `Le pays sélectionné (${selectedCountry}) ne correspond pas au pays détecté (${detectedCountry}).`;
            document.getElementById('warningModal').classList.remove('hidden');
        }

        function closeWarningModal() {
            document.getElementById('warningModal').classList.add('hidden');
        }

        function validateCountrySelection() {
            const countrySelect = document.getElementById('country');
            const selectedCountry = countrySelect.value;

            if (detectedCountry && selectedCountry && selectedCountry !== detectedCountry) {
                showWarningModal(selectedCountry);
                countrySelect.value = '';
                return false;
            }
            return true;
        }

        async function loadCountries() {
            try {
                const [response, ipCountry] = await Promise.all([
                    fetch('https://restcountries.com/v3.1/all'),
                    verifyIPCountry()
                ]);

                const countries = await response.json();
                const countrySelect = document.getElementById('country');
                const sortedCountries = countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

                sortedCountries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name.common;
                    option.textContent = country.name.common;
                    countrySelect.appendChild(option);
                });

                if (ipCountry) {
                    const matchingOption = Array.from(countrySelect.options).find(option => option.value === ipCountry);
                    if (matchingOption) {
                        countrySelect.value = ipCountry;
                    }
                }
            } catch (error) {
                alert('Erreur lors du chargement des pays. Veuillez réessayer plus tard.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadCountries);
    </script>
@endsection