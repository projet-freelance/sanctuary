@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Passer une commande</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->title }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><strong>Prix : {{ $product->price }} €</strong></p>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                    <label for="delivery_address">Adresse de livraison</label>
                    <textarea name="delivery_address" id="delivery_address" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Confirmer la commande</button>
            </form>
        </div>
    </div>
</div>
@endsection