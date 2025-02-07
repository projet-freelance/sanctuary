<div class="w-full max-w-2xl space-y-6">
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-blue-100 transform transition-all hover:scale-[1.02]">
            <h1 class="text-3xl font-bold text-blue-800 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                Piocher Anges De La Situation
            </h1>

            @if($selectedAnge)
                <div class="bg-blue-50 rounded-xl p-4 mb-4 animate-fade-in">
                    <h2 class="text-2xl font-semibold text-blue-900 mb-2">{{ $selectedAnge }}</h2>
                    <p class="text-blue-700">{{ $description }}</p>
                </div>
            @else
                <p class="text-gray-600 italic mb-4">Cliquez sur le bouton pour piocher un ange ou un groupe.</p>
            @endif

            <button wire:click="pickRandomAnge" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 
                    transition-colors duration-300 flex items-center justify-center space-x-2 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Piocher un ange ou un groupe</span>
            </button>
        </div>