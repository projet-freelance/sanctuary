@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text">Prix: €{{ number_format($product->price, 2) }}</p>
                <p class="card-text">Catégorie: {{ $product->category }}</p>
                <p class="card-text">Stock disponible: {{ $product->stock }}</p>
                <p class="card-text">
                    <strong>{{ $product->isAvailable() ? 'Disponible' : 'Indisponible' }}</strong>
                </p>
            </div>
        </div>
    </div>
@endsection
