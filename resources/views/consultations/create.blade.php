@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="px-6 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-purple-900 mb-4">Planifier une Consultation Spirituelle</h1>
                    <p class="text-xl text-gray-600 mb-8">Prenez un moment pour partager vos préoccupations avec nous</p>
                </div>

                <form action="{{ route('consultations.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-6">
                        <!-- Type de consultation -->
                        <div>
                            <label for="type" class="block text-lg font-medium text-purple-900 mb-2">Type de consultation</label>
                            <select name="type" id="type" required 
                                class="mt-1 block w-full px-4 py-3 border border-purple-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-700">
                                <option value="confession" {{ old('type') == 'confession' ? 'selected' : '' }}>Confession</option>
                                <option value="guidance" {{ old('type') == 'guidance' ? 'selected' : '' }}>Guidance spirituelle</option>
                                <option value="prayer" {{ old('type') == 'prayer' ? 'selected' : '' }}>Prière commune</option>
                            </select>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-lg font-medium text-purple-900 mb-2">Vos préoccupations (confidentiel)</label>
                            <textarea name="notes" id="notes" rows="6" 
                                class="mt-1 block w-full px-4 py-3 border border-purple-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Partagez vos pensées ou préoccupations...">{{ old('notes') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Vos informations resteront strictement confidentielles</p>
                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton de confirmation -->
                    <div class="mt-8">
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-6 border border-transparent rounded-full shadow-lg text-lg font-medium text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300">
                            Confirmer la consultation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
