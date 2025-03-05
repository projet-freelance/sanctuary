<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketPaymentResource\Pages;
use App\Filament\Resources\TicketPaymentResource\RelationManagers;
use App\Models\TicketPayment;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TicketPaymentResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Tu peux ajouter des champs de formulaire ici pour la création ou l'édition
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ticket_code')
                    ->label('Ticket Code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.name')
                    ->label('Event Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->label('Payment Amount')
                    ->money('usd'), // Suppose que tu utilises 'usd' comme devise
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Payment Date')
                    ->dateTime('d/m/Y H:i'),

                // Correction: Utilisation de TextColumn pour afficher "Paid" ou "Pending"
                Tables\Columns\TextColumn::make('is_paid')
                    ->label('Payment Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Paid' : 'Pending'),
            ])
            ->filters([
                // Tu peux ajouter des filtres pour affiner la recherche
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tu peux définir des relations supplémentaires si nécessaire
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketPayments::route('/'),
            'create' => Pages\CreateTicketPayment::route('/create'),
            'edit' => Pages\EditTicketPayment::route('/{record}/edit'),
        ];
    }
}
