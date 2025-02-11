<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required(),

                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Produit')
                    ->required(),

                TextInput::make('total_price')
                    ->numeric()
                    ->prefix('FCFA')
                    ->label('Prix total')
                    ->required(),

                TextInput::make('paid_amount')
                    ->numeric()
                    ->prefix('FCFA')
                    ->label('Montant payé')
                    ->default(0),

                Select::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'partially_paid' => 'Partiellement payé',
                        'paid' => 'Payé',
                        'delivered' => 'Livré',
                    ])
                    ->label('Statut')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest('created_at'))
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('product.name')
                    ->label('Produit')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_price')
                    ->label('Prix total')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->sortable(),

                TextColumn::make('paid_amount')
                    ->label('Montant payé')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Statut')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'En attente',
                        'partially_paid' => 'Partiellement payé',
                        'paid' => 'Payé',
                        'delivered' => 'Livré',
                    })
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'partially_paid' => 'info',
                        'paid' => 'success',
                        'delivered' => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Date de commande')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
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

    public static function getRelations(): array
    {
        return [];
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
