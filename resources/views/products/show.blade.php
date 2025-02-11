@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-6 hidden sm:block">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('products.index') }}" class="hover:text-indigo-600">Produits</a></li>
                <li><span class="px-2">/</span></li>
                <li class="text-gray-900 font-medium">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Conteneur principal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Image du produit -->
            <div class="relative aspect-w-4 aspect-h-3">
                <img 
                    src="{{ asset('storage/' . $product->image) }}" 
                    alt="{{ $product->name }}"
                    class="w-full"
                >
            </div>

            <!-- Contenu -->
            <div class="p-6">
                <!-- En-tête produit -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
                    <p class="text-gray-600 text-base">{{ $product->description }}</p>
                </div>

                <!-- Prix -->
                <div class="mb-6">
                    <div class="text-2xl font-bold text-indigo-600">
                        {{ number_format($product->price, 2, ',', ' ') }} €
                    </div>
                </div>

                <!-- Formulaire de commande -->
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Section paiement -->
                    <div class="space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900">Commander maintenant</h3>
                        <p class="text-sm text-gray-600">
                            Paiement en deux fois : 50% maintenant, 50% à la livraison
                        </p>

                        <!-- Résumé paiement -->
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Premier paiement (50%)</span>
                                <span class="font-medium">{{ number_format($product->price * 0.5, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Second paiement (50%)</span>
                                <span class="font-medium">{{ number_format($product->price * 0.5, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="pt-2 border-t">
                                <div class="flex justify-between text-base font-semibold">
                                    <span>Total</span>
                                    <span>{{ number_format($product->price, 2, ',', ' ') }} €</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'action -->
                    <div class="pt-4">
                        @auth
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200 flex items-center justify-center space-x-2">
                                <span>Procéder au paiement</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-gray-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-gray-700 transition duration-200 flex items-center justify-center">
                                Se connecter pour commander
                            </a>
                        @endauth
                    </div>
                </form>

                <!-- Messages de statut -->
                @if (session('success'))
                    <div class="mt-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.aspect-w-4 {
    position: relative;
    padding-bottom: 75%;
}
.aspect-w-4 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>
@endsection