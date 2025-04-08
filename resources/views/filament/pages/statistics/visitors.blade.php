<!-- resources/views/filament/pages/statistics/visitors.blade.php -->
<div>
    <div class="space-y-4">
        @if ($visitors->count() > 0)
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left px-4 py-2">Identifiant</th>
                        <th class="text-center px-4 py-2">Visites</th>
                        <th class="text-right px-4 py-2">Première visite</th>
                        <th class="text-right px-4 py-2">Dernière visite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $visitor)
                        <tr class="@if($loop->even) bg-gray-50 @endif">
                            <td class="px-4 py-2">{{ substr($visitor->visitor_hash, 0, 15) }}...</td>
                            <td class="text-center px-4 py-2">{{ $visitor->visit_count }}</td>
                            <td class="text-right px-4 py-2">{{ $visitor->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right px-4 py-2">{{ $visitor->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center p-4">
                <p class="text-gray-500">Aucun visiteur enregistré pour cette page.</p>
            </div>
        @endif
    </div>
</div>