<div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-green-100 transform transition-all hover:scale-[1.02]">
    <h2 class="text-2xl font-bold text-green-800 mb-6 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Oraisons Piochées
    </h2>

    @if(count($selectedOraisons) > 0)
        <ul class="space-y-3 mb-6 max-h-60 overflow-y-auto">
            @foreach($selectedOraisons as $oraison)
                <li class="bg-green-50 p-3 rounded-lg text-green-800 shadow-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ $oraison }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600 italic mb-6">Aucune oraison piochée.</p>
    @endif

    <button wire:click="piocherOraisons" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 
            transition-colors duration-300 flex items-center justify-center space-x-2
            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        <span>Re-piocher les oraisons</span>
    </button>
</div>
