@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $book }} - Chapitre {{ $chapter }}</h1>
    
    @if(!empty($verses))
        <div class="bg-white p-4 rounded shadow">
            @foreach($verses as $verseNumber => $verseText)
                <p class="mb-2">
                    <strong>{{ $verseNumber }}:</strong> 
                    {{ $verseText }}
                </p>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Aucun verset trouvé pour ce chapitre.</p>
    @endif
</div>
@endsection