@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Soumettre une intention de prière
                    </div>
                    <div class="card-body">
                        <form action="{{ route('prayer-intentions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre intention de prière (Message)</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Entrez votre intention de prière ici..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="audio" class="form-label">Fichier audio (facultatif)</label>
                                <input type="file" class="form-control" name="audio" accept="audio/*">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-4">Soumettre l'intention</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
