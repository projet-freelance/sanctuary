@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $testimony->title }}</h1>
    <p>{{ $testimony->content }}</p>

    @if($testimony->type == 'vocal')
    <audio controls>
        <source src="{{ asset('storage/' . $testimony->audio_path) }}" type="audio/mp3">
        Votre navigateur ne supporte pas l'élément audio.
    </audio>
    @endif

    <a href="{{ route('testimonies.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
