@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold text-gray-900 mb-2">Planifier une Consultation Spirituelle</h1>
                    <p class="text-gray-600 mb-8">Prenez un moment pour partager vos préoccupations avec nous</p>
                </div>

                <form action="{{ route('consultations.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-4">
                        

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de consultation</label>
                            <select name="type" id="type" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="confession">Confession</option>
                                <option value="guidance">Guidance spirituelle</option>
                                <option value="prayer">Prière commune</option>
                            </select>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Vos préoccupations (confidentiel)
                            </label>
                            <textarea name="notes" id="notes" rows="4" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Partagez vos pensées ou préoccupations..."></textarea>
                            <p class="mt-2 text-sm text-gray-500">
                                Vos informations resteront strictement confidentielles
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Confirmer la consultation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
