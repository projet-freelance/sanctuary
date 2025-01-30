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

                    <!-- Historique des paiements -->
                    <div>
                        <h2 class="text-lg font-medium text-purple-900">Historique des Paiements</h2>

                        @if($consultation->paiements->isEmpty())
                            <p class="text-gray-600">Aucun paiement effectué pour cette consultation.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($consultation->paiements as $payment)
                                    <li class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
                                        <div class="flex flex-col">
                                            <span class="text-gray-700 font-medium">Montant : {{ $payment->amount }} €</span>
                                            <span class="text-sm text-gray-500">Transaction ID : {{ $payment->transaction_id }}</span>
                                            <span class="text-sm text-gray-500">Méthode de paiement : {{ ucfirst($payment->payment_method) }}</span>
                                            <span class="text-sm text-gray-500">Date : {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div>
                                            <span class="px-4 py-2 text-white text-sm rounded-full 
                                            @if($payment->status == 'successful') bg-green-500 @elseif($payment->status == 'failed') bg-red-500 @else bg-yellow-500 @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

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