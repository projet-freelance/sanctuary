@extends('layouts.app')

@section('content')
    <h1>Ajouter une Prière</h1>

    <form action="{{ route('prayers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="intention">Intention :</label>
            <input type="text" name="intention" id="intention" required>
        </div>
        <div>
            <label for="audio_path">Audio (optionnel) :</label>
            <input type="file" name="audio_path" id="audio_path" accept="audio/*">
        </div>
        <div>
            <label for="status">Statut :</label>
            <select name="status" id="status" required>
                <option value="en cours">En cours</option>
                <option value="exaucée">Exaucée</option>
                <option value="en attente">En attente</option>
            </select>
        </div>
        <div>
            <label for="category">Catégorie :</label>
            <input type="text" name="category" id="category" required>
        </div>
        <div>
            <label for="privacy_level">Niveau de confidentialité :</label>
            <select name="privacy_level" id="privacy_level" required>
                <option value="public">Public</option>
                <option value="privé">Privé</option>
                <option value="communauté">Communauté</option>
            </select>
        </div>
        <div>
            <label for="prayer_type">Type de Prière :</label>
            <select name="prayer_type" id="prayer_type" required>
                <option value="intercession">Intercession</option>
                <option value="gratitude">Gratitude</option>
                <option value="demande">Demande</option>
            </select>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection
