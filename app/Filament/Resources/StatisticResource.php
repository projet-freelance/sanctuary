<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Filament\Resources\StatisticResource\RelationManagers;
use App\Models\Statistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Analytics';
    protected static ?string $modelLabel = 'Statistique';
    protected static ?string $pluralModelLabel = 'Statistiques';
    protected static ?string $navigationLabel = 'Analytics du site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->afterStateHydrated(function ($component, $state) {
                        $component->state(Str::start($state, '/'));
                    }),
                
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->default(now()),
                
                Forms\Components\TextInput::make('visits')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Statistic $record) => $record->date->format('d/m/Y'))
                    ->url(fn (Statistic $record) => url($record->page), true),
                
                Tables\Columns\TextColumn::make('visits')
                    ->numeric()
                    ->sortable()
                    ->alignEnd()
                    ->label('Visites')
                    ->color(fn (Statistic $record) => $record->visits > 100 ? 'success' : 'gray'),
                
                Tables\Columns\TextColumn::make('unique_visitors_count')
                    ->label('Visiteurs uniques')
                    ->numeric()
                    ->sortable()
                    ->alignEnd()
                    ->getStateUsing(fn (Statistic $record) => $record->visitors()->count()),
                
                Tables\Columns\TextColumn::make('date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('page')
                    ->options(function() {
                        // Liste prédéfinie de vos pages principales
                        $predefinedPages = [
                            '/' => 'Accueil',
                            '/about' => 'À propos',
                            '/bible' => 'Bible',
                            '/bible_videos' => 'Vidéos bibliques',
                            '/versets' => 'Versets',
                            '/prieres' => 'Prières',
                            '/testimonies' => 'Témoignages',
                            '/boutique' => 'Boutique',
                            '/events' => 'Événements',
                            '/products' => 'Produits',
                            '/consultations' => 'Consultations',
                            '/radios' => 'Radios',
                            '/meditate' => 'Méditation',
                            '/chat' => 'Chat'
                        ];
                        
                        // Fusionner avec les pages existantes dans la base de données
                        $dbPages = Statistic::query()
                            ->orderBy('page')
                            ->pluck('page', 'page')
                            ->unique()
                            ->toArray();
                        
                        return array_merge($predefinedPages, $dbPages);
                    })
                    ->searchable()
                    ->label('Page'),
                
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Du')
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Au')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
                    ->label('Période'),
                
                Tables\Filters\Filter::make('high_traffic')
                    ->label('Trafic élevé')
                    ->query(fn ($query) => $query->where('visits', '>', 100))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_visitors')
                    ->label('Voir visiteurs')
                    ->icon('heroicon-o-users')
                    ->modalHeading(fn (Statistic $record) => "Visiteurs pour {$record->page} - {$record->date->format('d/m/Y')}")
                    ->modalContent(fn (Statistic $record) => view('filament.pages.statistics.visitors', [
                        'visitors' => $record->visitors()->orderByDesc('visit_count')->get()
                    ])),
                
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VisitorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit' => Pages\EditStatistic::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\StatisticResource\Widgets\HomePageStats::class,
            \App\Filament\Resources\StatisticResource\Widgets\PageViewsChart::class,
            \App\Filament\Resources\StatisticResource\Widgets\PopularPagesChart::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Statistic::query()
            ->whereDate('date', today())
            ->sum('visits');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}