@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des consultations programmées</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Type de Consultation</th>
                <th>Date & Heure</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->user->name }}</td>
                    <td>{{ $consultation->type }}</td>
                    <td>{{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d/m/Y H:i') }}</td>
                    <td><span class="badge bg-warning">Programmée</span></td>
                    <td>
                        <form action="{{ route('admin.consultations.complete', $consultation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Marquer comme terminée</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $consultations->links() }} <!-- Pagination -->
</div>
@endsection
