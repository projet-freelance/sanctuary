@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Nos Produits</h1>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Prix : {{ $product->price }} €</strong></p>
                        <a href="{{ route('orders.create', $product) }}" class="btn btn-primary">Commander</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
