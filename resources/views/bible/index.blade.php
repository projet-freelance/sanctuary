@extends('layouts.app')

@section('head')
<script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>
@endsection

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

                        <!-- Paramètres de lecture vocale -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Paramètres de lecture</h3>
                            
                            <!-- Sélection de la langue -->
                            <div class="mb-3">
                                <label for="voice-language" class="block text-sm font-medium text-gray-700 mb-1">
                                    Langue
                                </label>
                                <select id="voice-language" class="w-full p-2 border border-gray-300 rounded">
                                    <option value="French Female">Français (Femme)</option>
                                    <option value="French Male">Français (Homme)</option>
                                    <option value="UK English Female">Anglais UK (Femme)</option>
                                    <option value="UK English Male">Anglais UK (Homme)</option>
                                    <option value="US English Female">Anglais US (Femme)</option>
                                    <option value="US English Male">Anglais US (Homme)</option>
                                </select>
                            </div>

                            <!-- Contrôle de la vitesse -->
                            <div class="mb-3">
                                <label for="voice-speed" class="block text-sm font-medium text-gray-700 mb-1">
                                    Vitesse
                                </label>
                                <input 
                                    type="range" 
                                    id="voice-speed" 
                                    min="0.5" 
                                    max="1.5" 
                                    step="0.1" 
                                    value="1"
                                    class="w-full"
                                >
                                <div class="text-xs text-gray-500 mt-1">
                                    <span id="speed-value">1.0</span>x
                                </div>
                            </div>

                            <!-- Contrôle du volume -->
                            <div class="mb-3">
                                <label for="voice-volume" class="block text-sm font-medium text-gray-700 mb-1">
                                    Volume
                                </label>
                                <input 
                                    type="range" 
                                    id="voice-volume" 
                                    min="0" 
                                    max="1" 
                                    step="0.1" 
                                    value="1"
                                    class="w-full"
                                >
                                <div class="text-xs text-gray-500 mt-1">
                                    <span id="volume-value">100</span>%
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
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
                            <!-- Bouton pour lire tout le chapitre -->
                            <button 
                                onclick="readChapter()" 
                                class="mt-3 text-white bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Lire le chapitre
                            </button>
                        </div>

                        <div class="p-4 space-y-4">
                            @foreach($verses as $verseNumber => $verseText)
                                <div class="verse-container hover:bg-gray-50 p-2 rounded flex items-center gap-2">
                                    <p class="text-base md:text-lg flex-grow">
                                        <span class="font-semibold text-blue-600 mr-2">{{ $verseNumber }}</span>
                                        <span class="verse-text">{{ $verseText }}</span>
                                    </p>
                                    <button 
                                        onclick="readVerse('{{ addslashes($verseText) }}')" 
                                        class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
                                        </svg>
                                        Lire
                                    </button>
                                    <button 
                                        onclick="stopReading()" 
                                        class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation entre chapitres -->
                        <div class="flex justify-between items-center p-4">
                            @if($currentChapter > 1)
                                <a 
                                    href="{{ route('bible.show', ['book' => $currentBook, 'chapter' => $currentChapter - 1]) }}" 
                                    class="text-white bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded">
                                    &larr; Chapitre Précédent
                                </a>
                            @else
                                <span></span>
                            @endif

                            @if($currentChapter < ($bookChapters[$currentBook] ?? 150))
                                <a 
                                    href="{{ route('bible.show', ['book' => $currentBook, 'chapter' => $currentChapter + 1]) }}" 
                                    class="text-white bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded">
                                    Chapitre Suivant &rarr;
                                </a>
                            @else
                                <span></span>
                            @endif
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
// Variable pour vérifier si le système vocal est prêt
let voiceReady = false;

// Fonction pour initialiser ResponsiveVoice
function initializeVoice() {
    return new Promise((resolve, reject) => {
        if (typeof responsiveVoice === 'undefined') {
            reject('ResponsiveVoice n\'est pas chargé');
            return;
        }

        // Vérifiez la disponibilité de la fonction speak comme indicateur d'initialisation
        if (typeof responsiveVoice.speak === 'function') {
            voiceReady = true;
            resolve();
        } else {
            reject('ResponsiveVoice n\'est pas disponible');
        }
    });
}

// Initialiser dès que possible
document.addEventListener('DOMContentLoaded', () => {
    const loadingMessage = document.createElement('div');
    loadingMessage.id = 'voice-loading-message';
    loadingMessage.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: #4CAF50; color: white; padding: 10px; border-radius: 5px; display: none;';
    loadingMessage.textContent = 'Initialisation du système vocal...';
    document.body.appendChild(loadingMessage);

    loadingMessage.style.display = 'block';

    initializeVoice()
        .then(() => {
            loadingMessage.textContent = 'Système vocal prêt !';
            setTimeout(() => {
                loadingMessage.style.display = 'none';
            }, 2000);
        })
        .catch(error => {
            console.error('Erreur d\'initialisation:', error);
            loadingMessage.style.backgroundColor = '#f44336';
            loadingMessage.textContent = 'Erreur d\'initialisation du système vocal';
        });
});

// Fonction pour vérifier la disponibilité de ResponsiveVoice
function isVoiceReady() {
    return voiceReady && typeof responsiveVoice !== 'undefined' && typeof responsiveVoice.speak === 'function';
}

// Fonction pour lire un verset
async function readVerse(text) {
    try {
        if (!isVoiceReady()) {
            throw new Error('Le système vocal n\'est pas prêt.');
        }

        stopReading();

        const voice = document.getElementById('voice-language').value;
        const speed = parseFloat(document.getElementById('voice-speed').value);
        const volume = parseFloat(document.getElementById('voice-volume').value);

        responsiveVoice.speak(text, voice, {
            rate: speed,
            volume: volume,
            onend: () => console.log('Lecture terminée')
        });
    } catch (error) {
        console.error('Erreur de lecture:', error);
        alert('Le système de lecture vocale n\'est pas disponible. Veuillez rafraîchir la page.');
    }
}

// Fonction pour arrêter la lecture
function stopReading() {
    if (isVoiceReady()) {
        responsiveVoice.cancel();
    }
}

// Fonction pour lire le chapitre entier
async function readChapter() {
    try {
        if (!isVoiceReady()) {
            throw new Error('Le système vocal n\'est pas prêt.');
        }

        const verses = Array.from(document.querySelectorAll('.verse-text'))
            .map(verse => verse.textContent.trim());

        const voice = document.getElementById('voice-language').value;
        const speed = parseFloat(document.getElementById('voice-speed').value);
        const volume = parseFloat(document.getElementById('voice-volume').value);

        let currentVerseIndex = 0;

        function readNextVerse() {
            if (currentVerseIndex < verses.length) {
                responsiveVoice.speak(verses[currentVerseIndex], voice, {
                    rate: speed,
                    volume: volume,
                    onend: () => {
                        currentVerseIndex++;
                        readNextVerse();
                    }
                });
            }
        }

        stopReading();
        readNextVerse();
    } catch (error) {
        console.error('Erreur de lecture du chapitre:', error);
        alert('Le système de lecture vocale n\'est pas disponible. Veuillez rafraîchir la page.');
    }
}

// Les gestionnaires d'événements pour speed et volume restent les mêmes
document.getElementById('voice-speed').addEventListener('input', function(e) {
    document.getElementById('speed-value').textContent = e.target.value;
});

document.getElementById('voice-volume').addEventListener('input', function(e) {
    document.getElementById('volume-value').textContent = Math.round(e.target.value * 100);
});
</script>
@endsection