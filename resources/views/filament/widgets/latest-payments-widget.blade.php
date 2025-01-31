<div class="p-4 bg-white rounded-lg shadow">
    <h2 class="text-lg font-semibold mb-4">Consultations et Paiements du Jour</h2>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultant</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date et Heure</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paiements</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($this->getConsultations() as $consultation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $consultation->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"> {{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d/m/Y à H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach ($consultation->payments as $payment)
                            <div>{{ $payment->amount }} XOF - {{ $payment->status }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $consultation->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($consultation->status !== 'completed')
                            <button wire:click="markAsCompleted({{ $consultation->id }})" class="text-sm text-green-600 hover:text-green-900">Marquer comme terminée</button>
                        @else
                            <span class="text-sm text-gray-500">Terminée</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>