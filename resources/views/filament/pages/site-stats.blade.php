<!-- resources/views/filament/pages/site-stats.blade.php -->

<x-filament::page>
    <div class="space-y-6">
      
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow">
                <h3 class="text-xl font-medium text-gray-700">Nombre de vues du site</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $siteViews }}</p>
            </div>
            <div class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow">
                <h3 class="text-xl font-medium text-gray-700">Utilisateurs en ligne</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $usersOnline }}</p>
            </div>
        </div>
    </div>
</x-filament::page>
