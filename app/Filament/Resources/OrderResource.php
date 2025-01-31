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

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                
                Select::make('product_id')
                    ->relationship('product', 'title')
                    ->required(),
                
                Select::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'partially_paid' => 'Partiellement payé',
                        'paid' => 'Payé',
                        'delivered' => 'Livré',
                    ])
                    ->required(),
                
                TextInput::make('total_price')
                    ->numeric()
                    ->required(),
                
                TextInput::make('paid_amount')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable(),
                
                TextColumn::make('product.title')
                    ->label('Produit')
                    ->sortable(),
                
                TextColumn::make('total_price')
                    ->sortable(),
                
                TextColumn::make('paid_amount')
                    ->sortable(),
                
                TextColumn::make('status')
                    ->badge(fn ($state) => match ($state) {
                        'pending' => 'En attente',
                        'partially_paid' => 'Partiellement payé',
                        'paid' => 'Payé',
                        'delivered' => 'Livré',
                    })
                    ->colors(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'partially_paid' => 'info',
                        'paid' => 'success',
                        'delivered' => 'gray',
                    }),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // Ajouter des relations si nécessaire
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
