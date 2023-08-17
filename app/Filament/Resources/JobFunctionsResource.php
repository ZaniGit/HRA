<?php

namespace App\Filament\Resources;

use App\Models\JobFunctions;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobFunctionsResource\Pages;

class JobFunctionsResource extends Resource
{
    protected static ?string $model = JobFunctions::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nome da Função')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('salary')
                    ->rules(['required', 'numeric'])
                    ->numeric()
                    ->placeholder('Salario')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Time::make('start_time')
                    ->rules(['required', 'date_format:H:i:s'])
                    ->placeholder('Start Time')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Time::make('end_time')
                    ->rules(['required', 'date_format:H:i:s'])
                    ->placeholder('End Time')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Time::make('time_output_interval')
                    ->rules(['required', 'date_format:H:i:s'])
                    ->placeholder('Time Output Interval')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Time::make('time_entry_interval')
                    ->rules(['required', 'date_format:H:i:s'])
                    ->placeholder('Time Entry Interval')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('salary'),
                Tables\Columns::make('start_time'),
                Tables\Columns::make('end_time'),
                Tables\Columns::make('time_output_interval'),
                Tables\Columns::make('time_entry_interval'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            JobFunctionsResource\RelationManagers\EmployesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAllJobFunctions::route('/'),
            'create' => Pages\CreateJobFunctions::route('/create'),
            'edit' => Pages\EditJobFunctions::route('/{record}/edit'),
        ];
    }
}
