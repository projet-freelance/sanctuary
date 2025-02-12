<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('product_id')
                    ->label('Produit')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('total_price')
                    ->label('Prix Total')
                    ->required(),
                TextInput::make('paid_amount')
                    ->label('Montant Payé')
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'delivered' => 'Livré',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.city')
                    ->label('Ville')
                    ->sortable(),
                TextColumn::make('user.phone')
                    ->label('Téléphone')
                    ->sortable(),
                TextColumn::make('user.birthdate')
                    ->label('Date de Naissance')
                    ->date()
                    ->sortable(),
                TextColumn::make('user.country')
                    ->label('Pays')
                    ->sortable(),
                TextColumn::make('product.name')
                    ->label('Produit')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_price')
                    ->label('Prix Total'),
                TextColumn::make('paid_amount')
                    ->label('Montant Payé'),
                TextColumn::make('status')
                    ->label('Statut')
                    ->formatStateUsing(function ($state) {
                        return $state === 'delivered' ? '<span style="color:green;">Livré</span>' : $state;
                    })
                    ->html(),
                TextColumn::make('created_at')
                    ->label('Date de la Commande')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('validateDelivery')
                    ->label('Valider la livraison')
                    ->action(function (Order $record) {
                        $record->status = 'delivered';
                        $record->save();
                    })
                    ->color('success'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
