
<!-- Vue Blade avec lecture vocale -->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=auXJwGAn"></script>

<div class="bg-gradient-to-br from-blue-50 to-white min-h-[400px] p-6 rounded-2xl shadow-lg max-w-md mx-auto relative overflow-hidden"> 
    <div class="absolute top-0 right-0 opacity-30">
        <x-heroicon-o-sparkles class="w-48 h-48 text-blue-200" />
    </div>

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-blue-800 flex items-center justify-center gap-2">
            <x-heroicon-o-sparkles class="w-6 h-6 text-yellow-400" /> 
            Versets du Jour 
            <x-heroicon-o-sparkles class="w-6 h-6 text-yellow-400" />
        </h2>
    </div>

    @if(!$isComplete)
        <div class="bg-white rounded-xl p-6 shadow-md relative z-10">
            @if(count($verses) > 0)
                <div class="text-center">
                    <div class="absolute top-[-50px] left-1/2 transform -translate-x-1/2">
                        <img src="{{ asset('images/angel.jpg') }}" alt="Ange" class="w-24 h-24 rounded-full shadow-lg animate-float" />
                    </div>
                    
                    <div class="mt-12">
                        <p class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $verses[$currentVerseIndex]['reference'] }}
                        </p>
                        <p class="italic text-gray-600 mb-4" id="verseText">
                            {{ $verses[$currentVerseIndex]['text'] }}
                        </p>
                        
                        <button onclick="speakVerse()" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition flex items-center mx-auto gap-2">
                            Écouter <x-heroicon-o-play class="w-5 h-5" />
                        </button>
                        
                        <button wire:click="nextVerse" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition flex items-center mx-auto gap-2 mt-2">
                            Prochain Verset <x-heroicon-o-arrow-right class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">Aucun verset disponible.</p>
            @endif
        </div>
    @else
        <div class="text-center bg-white rounded-xl p-6 shadow-md">
            <h3 class="text-2xl font-bold text-green-600 mb-4">Félicitations! 🎉</h3>
            <p class="text-gray-700 mb-4">Vous avez lu tous les versets du jour. Revenez demain pour une nouvelle inspiration spirituelle!</p>
            <button wire:click="resetVerses" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition">
                Recommencer
            </button>
        </div>
    @endif
</div>

<script>
    function speakVerse() {
        let text = document.getElementById('verseText').innerText;
        responsiveVoice.speak(text, 'French Female');
    }
</script>

@push('styles')
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
@endpush
