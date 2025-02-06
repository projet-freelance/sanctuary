<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-8">
    <div class="container mx-auto max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-serif text-gray-800 mb-4">Exercice Spirituel</h1>
            <p class="text-gray-600">Méditation et réflexion quotidienne</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            @foreach (['peche', 'vertu', 'don', 'fruit'] as $key)
                <button wire:click="tirer('{{ $key }}')" class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-r from-{{ $key === 'peche' ? 'red' : ($key === 'vertu' ? 'blue' : ($key === 'don' ? 'green' : 'purple')) }}-500/10 to-{{ $key === 'peche' ? 'red' : ($key === 'vertu' ? 'blue' : ($key === 'don' ? 'green' : 'purple')) }}-600/10 transform group-hover:scale-105 transition-transform duration-300"></div>
                    <div class="relative p-6 text-center">
                        <div class="text-{{ $key === 'peche' ? 'red' : ($key === 'vertu' ? 'blue' : ($key === 'don' ? 'green' : 'purple')) }}-600 mb-3">
                            <i class="fas fa-{{ $key === 'peche' ? 'exclamation-triangle' : ($key === 'vertu' ? 'check-circle' : ($key === 'don' ? 'gift' : 'heart')) }} text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ ucfirst($key) }}</h3>
                    </div>
                </button>
            @endforeach
        </div>

        @if($elementTire && is_object($elementTire))
    <div class="bg-white rounded-xl shadow-lg p-8 transform transition-all duration-300">
        <h2 class="text-xl font-bold text-gray-800">{{ ucfirst($type) }} tiré :</h2>
        <p class="text-lg text-gray-600">{{ $elementTire->nom }}</p>
        <p class="text-sm text-gray-500">{{ $elementTire->description }}</p>

        @if($exercice)
            <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-800">Exercice associé :</h3>
                <p class="text-gray-600">{{ $exercice->titre }}</p>
                <p class="text-sm text-gray-500">{{ $exercice->contenu }}</p>
            </div>
        @endif
    </div>
@elseif($elementTire === null)
    <p class="text-lg text-gray-600">Aucun élément trouvé pour ce type.</p>
@else
    <p class="text-lg text-gray-600">Erreur lors du tirage de l'élément.</p>
@endif

    </div>
</div>
