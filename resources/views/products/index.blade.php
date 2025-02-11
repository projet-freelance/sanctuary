@extends('layouts.app')

@section('content')
    <x-latest-products :categories="$categories" :products="$products" :selectedCategory="$selectedCategory" />
@endsection