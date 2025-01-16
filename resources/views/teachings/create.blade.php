@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">Ajouter un Enseignement</h1>
            <p class="mt-2 text-gray-600">Remplissez le formulaire ci-dessous pour ajouter un nouvel enseignement.</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('teachings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Titre -->
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-medium text-gray-700 block">Titre de l'enseignement</label>
                        <input type="text" name="title" id="title" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                               placeholder="Entrez le titre de l'enseignement" required>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-gray-700 block">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                                  placeholder="Décrivez brièvement cet enseignement"></textarea>
                    </div>

                    <!-- Type d'enseignement -->
                    <div class="space-y-2">
                        <label for="type" class="text-sm font-medium text-gray-700 block">Type d'enseignement</label>
                        <select name="type" id="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                                required onchange="toggleFields()">
                            <option value="" disabled selected>Sélectionnez un type</option>
                            <option value="audio">Audio</option>
                            <option value="text">Texte</option>
                            <option value="video">Vidéo</option>
                            <option value="link">Lien partenaire</option>
                        </select>
                    </div>

                    <!-- Champs conditionnels -->
                    <div class="space-y-6">
                        <!-- Section Audio -->
                        <div id="audio-fields" class="hidden space-y-2">
                            <label for="audio_file" class="text-sm font-medium text-gray-700 block">Fichier audio</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="audio_file" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Télécharger un fichier</span>
                                            <input type="file" name="audio_file" id="audio_file" class="sr-only" accept="audio/*">
                                        </label>
                                        <p class="pl-1">ou déposez-le ici</p>
                                    </div>
                                    <p class="text-xs text-gray-500">MP3, WAV jusqu'à 50MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section Vidéo -->
                        <div id="video-fields" class="hidden space-y-2">
                            <label for="video_file" class="text-sm font-medium text-gray-700 block">Fichier vidéo</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="video_file" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Télécharger un fichier</span>
                                            <input type="file" name="video_file" id="video_file" class="sr-only" accept="video/*">
                                        </label>
                                        <p class="pl-1">ou déposez-le ici</p>
                                    </div>
                                    <p class="text-xs text-gray-500">MP4, AVI jusqu'à 200MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section Texte -->
                        <div id="text-fields" class="hidden space-y-2">
                            <label for="text_content" class="text-sm font-medium text-gray-700 block">Contenu de l'enseignement</label>
                            <textarea name="text_content" id="text_content" rows="8"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                                      placeholder="Rédigez votre enseignement ici..."></textarea>
                        </div>

                        <!-- Section Lien -->
                        <div id="link-fields" class="hidden space-y-2">
                            <label for="url" class="text-sm font-medium text-gray-700 block">Lien de l'enseignement</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </div>
                                <input type="url" name="url" id="url"
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                                       placeholder="https://exemple.com/enseignement">
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                                class="w-full sm:w-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Publier l'enseignement
                        </button>
                        <button type="button" onclick="window.history.back()"
                                class="w-full sm:w-auto flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFields() {
    const type = document.getElementById('type').value;
    const sections = ['audio-fields', 'video-fields', 'text-fields', 'link-fields'];
    
    // Masquer toutes les sections
    sections.forEach(section => {
        const element = document.getElementById(section);
        element.classList.add('hidden');
    });
    
    // Afficher la section appropriée
    if (type) {
        const activeSection = document.getElementById(`${type}-fields`);
        activeSection.classList.remove('hidden');
        
        // Animation simple d'apparition
        activeSection.style.opacity = '0';
        activeSection.style.transition = 'opacity 0.3s ease-in-out';
        setTimeout(() => {
            activeSection.style.opacity = '1';
        }, 50);
    }
}

// Gestion du drag & drop pour les fichiers
['audio_file', 'video_file'].forEach(inputId => {
    const dropZone = document.getElementById(inputId).closest('div.border-dashed');
    
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    });
    
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });
    
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        document.getElementById(inputId).files = e.dataTransfer.files;
    });
});

// Initialisation
document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection