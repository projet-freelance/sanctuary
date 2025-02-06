<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Full Name'),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->label('Email Address'),
                Forms\Components\TextInput::make('phone')
                    ->nullable()
                    ->maxLength(255)
                    ->label('Phone Number'),
                Forms\Components\TextInput::make('country')
                    ->nullable()
                    ->maxLength(255)
                    ->label('Country'),
                Forms\Components\TextInput::make('city')
                    ->nullable()
                    ->maxLength(255)
                    ->label('City'),
                Forms\Components\DatePicker::make('birthdate')
                    ->nullable()
                    ->label('Birthdate'),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('country')->sortable()->searchable(),
                TextColumn::make('city')->sortable()->searchable(),
                TextColumn::make('birthdate')->date()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                // You can add custom filters here if needed
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
            // Add related managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
