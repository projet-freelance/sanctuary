<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationResource\Pages;
use App\Models\Consultation;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions;
use Illuminate\Database\Eloquent\Builder;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Ajoutez ici les champs du formulaire
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('type')->label('Type de Consultation')->sortable()->searchable(),
                TextColumn::make('notes')->label('Notes')->limit(50)->sortable()->searchable(),
                TextColumn::make('scheduled_at')->label('Date et Heure')->sortable()->dateTime(),

                // ✅ Utilisation de IconColumn pour `status`
                IconColumn::make('status')
                    ->label('Statut')
                    ->sortable()
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'scheduled' => 'heroicon-o-calendar',
                        'completed' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'scheduled' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                // Assurez-vous que la relation `user` est définie dans le modèle `Consultation`
                TextColumn::make('user.name')->label('Utilisateur')->sortable()->searchable(),
                TextColumn::make('user.email')->label('Email Utilisateur')->sortable()->searchable(),
                TextColumn::make('user.phone')->label('Telephone')->sortable()->searchable(),
                TextColumn::make('user.city')->label('Ville')->sortable()->searchable(),
                TextColumn::make('user.country')->label('Pays')->sortable()->searchable(),
                TextColumn::make('user.birthdate')->label('Date Naissance')->sortable()->searchable(),
                // Ajouter un champ boolean pour la colonne `completed` si applicable
                CheckboxColumn::make('completed')->label('Terminée'),
                
            ])
            ->filters([
                // ✅ Ajout d'un filtre pour le statut
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'scheduled' => 'Planifiée',
                        'completed' => 'Terminée',
                        'cancelled' => 'Annulée',
                    ])
                    ->default('pending'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('scheduled_at', 'desc'); // ✅ Tri par défaut
    }

    public static function getRelations(): array
    {
        return [
            // Ajoutez les relations si nécessaire
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
