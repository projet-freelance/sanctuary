@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white flex flex-col">

    <!-- Contenu principal -->
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-3xl font-bold text-center  mb-6">Liste des Produits</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">

                    <div class="p-4">
                        <h5 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h5>
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-lg font-bold text-gray-800">€{{ number_format($product->price, 2) }}</p>

                        <a href="{{ route('products.show', $product) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                            Voir le produit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    

</div>
@endsection
