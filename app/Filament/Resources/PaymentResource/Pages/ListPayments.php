<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTable(): Tables\Table // Déclaré comme public
    {
        return parent::getTable() // Hérite de la table par défaut
            ->columns([
                Tables\Columns\TextColumn::make('consultation.type')
                    ->label('Type de Consultation')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->sortable()
                    ->money('EUR'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Méthode de Paiement'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_completed')
                    ->label('Consultation terminée')
                    ->sortable()
                    ->default(false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'consultation' => 'Consultation',
                        'product' => 'Produit',
                    ])
                    ->label('Type de Paiement'),
            ])
            ->actions([
                Tables\Actions\Action::make('Mark Completed')
                    ->label('Marquer comme Terminée')
                    ->action(function ($record) {
                        // Action pour marquer la consultation comme terminée
                        if ($record->consultation) {
                            $record->consultation->update([
                                'status' => 'completed',
                            ]);
                        }
                    })
            ]);
    }
}
