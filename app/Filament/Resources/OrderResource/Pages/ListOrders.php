<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use App\Models\Order;
use Filament\Tables\Filters\SelectFilter;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Suppression de l'action de création, car les paiements sont traités via PayDunya
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest('created_at'))
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'partially_paid' => 'Partiellement payé',
                        'paid' => 'Payé',
                        'delivered' => 'Livré',
                    ])
                    ->label('Filtrer par statut'),
            ]);
    }
}
