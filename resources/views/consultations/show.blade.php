@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="px-6 py-8">
                <h1 class="text-3xl font-bold text-purple-900 mb-8">Détails de votre Consultation</h1>
                
                <div class="space-y-6">
                    <!-- Date et Heure -->
                    <div class="border-b border-purple-100 pb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-medium text-purple-700">Date et Heure</span>
                            <span class="text-lg text-purple-900">{{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="border-b border-purple-100 pb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-medium text-purple-700">Statut</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($consultation->status === 'confirmé')
                                    bg-green-100 text-green-800
                                @elseif($consultation->status === 'en_attente')
                                    bg-yellow-100 text-yellow-800
                                @else
                                    bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($consultation->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="pt-4">
                        <h3 class="text-lg font-medium text-purple-700 mb-3">Notes</h3>
                        <p class="text-lg text-gray-900 bg-purple-50 rounded-lg p-4">
                            {{ $consultation->notes ?? 'Aucune note fournie.' }}
                        </p>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('consultations.index') }}" 
                        class="inline-flex items-center px-6 py-2 border border-purple-300 shadow-sm text-lg font-medium rounded-full text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection