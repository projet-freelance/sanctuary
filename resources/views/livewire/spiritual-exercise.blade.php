<div class="container mx-auto p-4">
    <div class="grid grid-cols-2 gap-4 mb-8">
        <button 
            wire:click="tirer('peche')"
            class="bg-red-500 text-white p-4 rounded"
            x-data
            x-on:click="$dispatch('element-tire')"
        >
            Tirer un péché
        </button>
        
        <button 
            wire:click="tirer('vertu')"
            class="bg-blue-500 text-white p-4 rounded"
            x-data
            x-on:click="$dispatch('element-tire')"
        >
            Tirer une vertu
        </button>
        
        <button 
            wire:click="tirer('don')"
            class="bg-green-500 text-white p-4 rounded"
            x-data
            x-on:click="$dispatch('element-tire')"
        >
            Tirer un don de l'Esprit Saint
        </button>
        
        <button 
            wire:click="tirer('fruit')"
            class="bg-purple-500 text-white p-4 rounded"
            x-data
            x-on:click="$dispatch('element-tire')"
        >
            Tirer un fruit de l'Esprit Saint
        </button>
    </div>

    <div 
        x-data="{ show: false }"
        x-on:element-tire.window="show = true; setTimeout(() => { show = false }, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-green-100 p-4 rounded shadow"
    >
        Nouvel élément tiré !
    </div>

    @if($elementTire)
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">
            {{ ucfirst($type) }} tiré(e) :
        </h2>
        <div class="text-xl">{{ $elementTire->nom }}</div>
        @if($elementTire->description)
            <p class="mt-4 text-gray-600">{{ $elementTire->description }}</p>
        @endif
    </div>
    @endif
</div>
