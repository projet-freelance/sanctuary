@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-3xl font-bold text-center mb-6">Ajouter un Témoignage</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('testimonies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Titre</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-lg font-semibold text-gray-700 mb-2">Contenu</label>
                    <textarea name="content" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-lg font-semibold text-gray-700 mb-2">Type</label>
                    <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="vocal">Vocal</option>
                        <option value="écrit">Écrit</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="audio_path" class="block text-lg font-semibold text-gray-700 mb-2">Audio (optionnel)</label>
                    <input type="file" name="audio_path" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="category" class="block text-lg font-semibold text-gray-700 mb-2">Catégorie</label>
                    <input type="text" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Créer
                </button>
            </form>
        </div>
    </div>

    
</div>
@endsection
