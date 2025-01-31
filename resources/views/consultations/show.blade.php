@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="px-6 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-purple-900 mb-4">Détails de la Consultation</h1>
                    <p class="text-xl text-gray-600 mb-8">Voici les informations concernant votre consultation.</p>
                </div>

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Type de consultation -->
                    <div>
                        <h2 class="text-lg font-medium text-purple-900">Type de Consultation</h2>
                        <p class="text-gray-600">{{ ucfirst($consultation->type) }}</p>
                    </div>

                    <!-- Date et heure de la consultation -->
                    <div>
                        <h2 class="text-lg font-medium text-purple-900">Date et Heure de la Consultation</h2>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d M Y, H:i') }}</p>
                    </div>

                    <!-- Notes -->
                    @if($consultation->notes)
                    <div>
                        <h2 class="text-lg font-medium text-purple-900">Vos Préoccupations</h2>
                        <p class="text-gray-600">{{ $consultation->notes }}</p>
                    </div>
                    @endif

                <div class="mt-8 text-center">
                    <a href="{{ route('consultations.index') }}" 
                       class="text-lg font-medium text-purple-700 hover:text-purple-800">
                        Retour à la liste des consultations
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection