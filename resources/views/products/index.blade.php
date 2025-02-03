@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col bg-gray-100">
        <div class="container mx-auto p-6 flex-grow">
            <h1 class="text-3xl font-bold text-center mb-6">Nos Produits</h1>
            
            <!-- Vue.js application -->
            <div id="app">
                <product-list></product-list>
            </div>
        </div>
    </div>
@endsection
