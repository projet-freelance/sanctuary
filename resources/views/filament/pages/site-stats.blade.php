<x-filament::page>
    <div class="grid grid-cols-2 gap-4 bg-white p-6 rounded-lg shadow-md">
        <div class="col-span-2 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Statistiques du Site</h2>
            <hr class="border-t-2 border-blue-500 my-2">
        </div>

        <div class="bg-blue-50 p-4 rounded-lg">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total des vues du site</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $siteViews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 p-4 rounded-lg">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Utilisateurs en ligne</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $usersOnline }}</p>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>