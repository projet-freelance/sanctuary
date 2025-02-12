<?php

namespace App\Filament\Resources\ConsultationResource\Pages;

use App\Filament\Resources\ConsultationResource;
use App\Models\Consultation;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ListConsultations extends ListRecords
{
    protected static string $resource = ConsultationResource::class;

    protected function getTableQuery(): Builder
{
    return Consultation::query()
        ->whereBetween('scheduled_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->whereIn('status', ['pending', 'scheduled', 'completed', 'cancelled']); // Remplacer 'successful' par d'autres statuts
}


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('type')->label('Type de Consultation')->sortable()->searchable(),
            TextColumn::make('notes')->label('Notes')->limit(50)->sortable()->searchable(),
            TextColumn::make('scheduled_at')->label('Date et Heure')->sortable()->dateTime(),
            
            // Remplacement de BadgeColumn par IconColumn pour le statut
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

            // Relation utilisateur (assurez-vous que la relation est correctement définie dans le modèle Consultation)
            TextColumn::make('user.name')->label('Utilisateur')->sortable()->searchable(),
            TextColumn::make('user.email')->label('Email Utilisateur')->sortable()->searchable(),
            CheckboxColumn::make('completed')->label('Terminée'),
            
            // Icône pour le champ `is_featured`
            IconColumn::make('is_featured')
                ->label('Mise en avant')
                ->boolean()
                ->trueIcon('heroicon-o-check-badge')
                ->falseIcon('heroicon-o-x-mark'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('complete')
                ->label('Marquer comme terminées')
                ->action(fn (array $records) => $this->completeConsultations($records))
                ->requiresConfirmation()
                ->icon('heroicon-o-check'),
        ];
    }

    protected function completeConsultations(array $records): void
    {
        Consultation::whereIn('id', $records)->update(['status' => 'completed']);
    }

    protected function getGroupedTableColumns(): array
    {
        return [
            TextColumn::make('scheduled_at')->label('Date')
                ->date()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('type')->label('Type de Consultation')->sortable()->searchable(),
            TextColumn::make('user.name')->label('Utilisateur')->sortable()->searchable(),
        ];
    }

    protected function applyTableGrouping(Table $table): Table
    {
        return $table
            ->columns($this->getGroupedTableColumns())
            ->filters([])  // Vous pouvez ajouter des filtres ici si nécessaire.
            ->bulkActions($this->getTableBulkActions());
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
