<?php

namespace App\Filament\Resources\TicketsRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets'; // La relation doit correspondre au nom de la méthode dans le modèle

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->maxLength(10),
                // Vous pouvez ajouter d'autres champs ici si nécessaire
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name') // Définit la colonne à utiliser comme titre du ticket
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')->money('usd'),
                // Vous pouvez ajouter d'autres colonnes ici pour afficher des informations supplémentaires
            ])
            ->filters([ /* Si vous avez des filtres, vous pouvez les ajouter ici */])
            ->headerActions([
                Tables\Actions\CreateAction::make(), // Permet de créer un nouveau ticket
            ])
            ->actions([
                Tables\Actions\EditAction::make(),   // Permet d'éditer un ticket
                Tables\Actions\DeleteAction::make(), // Permet de supprimer un ticket
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Permet de supprimer plusieurs tickets à la fois
                ]),
            ]);
    }
}
