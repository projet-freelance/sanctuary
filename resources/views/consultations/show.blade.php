@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Détails de votre Consultation</h1>
                
                <div class="space-y-4">
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Date et Heure</span>
                            <span class="text-sm text-gray-900">{{ $consultation->scheduled_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Statut</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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

                    <div class="pt-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Notes</h3>
                        <p class="text-sm text-gray-900">{{ $consultation->notes ?? 'Aucune note fournie.' }}</p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('consultations.index') }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection