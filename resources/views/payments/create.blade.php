@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Paiement de la commande</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Commande #{{ $order->id }}</h5>
            <p class="card-text"><strong>Produit :</strong> {{ $order->product->title }}</p>
            <p class="card-text"><strong>Montant total :</strong> {{ $order->total_amount }} €</p>
            <p class="card-text"><strong>Montant à payer (50 %) :</strong> {{ $order->total_amount * 0.5 }} €</p>

            <form action="{{ route('payments.make', $order) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="card_number">Numéro de carte</label>
                    <input type="text" name="card_number" id="card_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Date d'expiration</label>
                    <input type="text" name="expiry_date" id="expiry_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" id="cvv" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Payer maintenant</button>
            </form>
        </div>
    </div>
</div>
@endsection