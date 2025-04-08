<?php

namespace App\Filament\Resources\StatisticResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VisitorsRelationManager extends RelationManager
{
    protected static string $relationship = 'visitors';
    
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('visitor_hash')
                ->required()
                ->label('Identifiant du visiteur'),
            Forms\Components\TextInput::make('visit_count')
                ->numeric()
                ->required()
                ->label('Nombre de visites'),
        ]);
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visitor_hash')
                    ->label('Identifiant du visiteur')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('visit_count')
                    ->label('Nombre de visites')
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Première visite')
                    ->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Dernière visite')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}