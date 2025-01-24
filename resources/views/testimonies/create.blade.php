@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-8 sm:p-10">
            <h1 class="text-2xl sm:text-3xl font-bold text-center text-blue-800 mb-6">
                <i class="fas fa-comment-heart mr-2 text-red-500"></i>Partager votre Témoignage
            </h1>

            <form action="{{ route('testimonies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre du Témoignage</label>
                    <input 
                        type="text" 
                        name="title" 
                        required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition ease-in-out duration-150"
                        placeholder="Un titre significatif..."
                    >
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de Témoignage</label>
                    <select 
                        id="testimony-type" 
                        name="type" 
                        required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                    >
                        <option value="vocal">Témoignage Audio</option>
                        <option value="écrit">Témoignage Écrit</option>
                    </select>
                </div>

                <div id="text-content" class="hidden">
                    <label for="content" class="block text-sm font-medium text-gray-700">Votre Témoignage</label>
                    <textarea 
                        name="content" 
                        rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                        placeholder="Partagez comment Dieu a agi dans votre vie..."
                    ></textarea>
                </div>

                <div id="audio-content">
                    <label for="audio_path" class="block text-sm font-medium text-gray-700">
                        Enregistrement Audio 
                        <span class="text-gray-500 text-xs">(MP3, WAV)</span>
                    </label>
                    <input 
                        type="file" 
                        name="audio_path" 
                        accept="audio/mp3,audio/wav,audio/mpeg" 
                        class="mt-1 block w-full text-sm text-gray-500 
                        file:mr-4 file:py-2 file:px-4 
                        file:rounded-full file:border-0 
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100"
                    >
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 
                        border border-transparent rounded-md 
                        shadow-sm text-sm font-medium text-white 
                        bg-blue-600 hover:bg-blue-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 
                        transition duration-300 ease-in-out transform hover:-translate-y-1"
                    >
                        <i class="fas fa-heart mr-2"></i> Partager mon Témoignage
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('testimony-type').addEventListener('change', function() {
    const textContent = document.getElementById('text-content');
    const audioContent = document.getElementById('audio-content');
    const contentTextarea = textContent.querySelector('textarea');
    const audioInput = audioContent.querySelector('input');

    if (this.value === 'écrit') {
        textContent.classList.remove('hidden');
        audioContent.classList.add('hidden');
        contentTextarea.required = true;
        audioInput.required = false;
    } else {
        textContent.classList.add('hidden');
        audioContent.classList.remove('hidden');
        contentTextarea.required = false;
        audioInput.required = true;
    }
});

// Trigger initial state
document.getElementById('testimony-type').dispatchEvent(new Event('change'));
</script>
@endsection