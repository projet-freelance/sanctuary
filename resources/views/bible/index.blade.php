@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">
    <div class="container mx-auto p-4 md:p-6 flex-grow">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Panneau de navigation -->
            <div class="w-full md:w-1/4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Navigation Bible</h2>
                    <form action="{{ route('bible.show') }}" method="GET" id="bibleForm">
                        <!-- Sélection du livre -->
                        <div class="mb-4">
                            <label for="book" class="block text-sm font-medium text-gray-700 mb-1">
                                Livre
                            </label>
                            <select 
                                name="book" 
                                id="book"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                onchange="this.form.submit()"
                            >
                                @foreach($books as $book)
                                    <option value="{{ $book }}" 
                                        {{ isset($currentBook) && $currentBook == $book ? 'selected' : '' }}>
                                        {{ $book }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection du chapitre -->
                        <div class="mb-4">
                            <label for="chapter" class="block text-sm font-medium text-gray-700 mb-1">
                                Chapitre
                            </label>
                            <select 
                                name="chapter" 
                                id="chapter"
                                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                onchange="this.form.submit()"
                            >
                                @for($i = 1; $i <= 150; $i++)
                                    <option value="{{ $i }}" 
                                        {{ isset($currentChapter) && $currentChapter == $i ? 'selected' : '' }}>
                                        Chapitre {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        @csrf
                    </form>

                    @if(isset($translation))
                        <div class="mt-4 text-sm text-gray-600">
                            Translation: {{ $translation }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contenu des versets -->
            <div class="w-full md:w-3/4">
                @if(isset($errorMessage))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <p class="font-medium">Erreur</p>
                        <p>{{ $errorMessage }}</p>
                    </div>
                @endif

                @if(!empty($verses))
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h1 class="text-2xl font-bold">
                                {{ $currentBook }} - Chapitre {{ $currentChapter }}
                            </h1>
                            @if(isset($reference))
                                <p class="text-sm text-gray-600 mt-1">{{ $reference }}</p>
                            @endif
                        </div>

                        <div class="p-4 space-y-4">
                            @foreach($verses as $verseNumber => $verseText)
                                <div class="verse-container hover:bg-gray-50 p-2 rounded">
                                    <p class="text-base md:text-lg">
                                        <span class="font-semibold text-blue-600 mr-2">{{ $verseNumber }}</span>
                                        <span class="verse-text">{{ $verseText }}</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white p-8 rounded-lg shadow text-center">
                        <p class="text-gray-600">
                            Sélectionnez un livre et un chapitre pour commencer la lecture.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mise à jour dynamique du nombre de chapitres selon le livre sélectionné
    const bookSelect = document.getElementById('book');
    const chapterSelect = document.getElementById('chapter');
    const currentChapter = {{ $currentChapter ?? 1 }};

    const bookChapters = {
        'Genesis': 50, 'Exodus': 40, 'Leviticus': 27, 'Numbers': 36, 'Deuteronomy': 34,
        'Joshua': 24, 'Judges': 21, 'Ruth': 4, '1 Samuel': 31, '2 Samuel': 24,
        '1 Kings': 22, '2 Kings': 25, '1 Chronicles': 29, '2 Chronicles': 36,
        'Psalms': 150, // et ainsi de suite pour tous les livres
    };

    function updateChapters() {
        const selectedBook = bookSelect.value;
        const chaptersCount = bookChapters[selectedBook] || 150; // par défaut 150 chapitres max

        // Sauvegarder le chapitre actuel
        const currentValue = chapterSelect.value;

        // Vider et recréer les options
        chapterSelect.innerHTML = '';
        for (let i = 1; i <= chaptersCount; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = `Chapitre ${i}`;
            if (i == currentValue && currentValue <= chaptersCount) {
                option.selected = true;
            }
            chapterSelect.appendChild(option);
        }
    }

    bookSelect.addEventListener('change', updateChapters);
    updateChapters(); // Exécuter au chargement
});
</script>
@endsection