@extends('layouts.app')

@section('content')
    <h1>Détail de la Prière</h1>

    <h2>{{ $prayer->intention }}</h2>
    <p>Type : {{ $prayer->prayer_type }}</p>
    <p>Statut : {{ $prayer->status }}</p>
    <p>Catégorie : {{ $prayer->category }}</p>
    <p>Niveau de confidentialité : {{ $prayer->privacy_level }}</p>
    <p>Créée par : {{ $prayer->user->name }}</p>

    @if ($prayer->audio_path)
        <audio controls>
            <source src="{{ Storage::url($prayer->audio_path) }}" type="audio/mpeg">
            Votre navigateur ne supporte pas la lecture audio.
        </audio>
    @endif

    <a href="{{ route('prayers.index') }}">Retour à la liste</a>
@endsection
