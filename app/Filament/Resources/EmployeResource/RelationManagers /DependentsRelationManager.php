<?php

namespace App\Filament\Resources\EmployeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class DependentsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'dependents';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nome')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                DatePicker::make('birth')
                    ->rules(['required', 'date'])
                    ->placeholder('Data Nascimento')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                TextInput::make('document_cpf')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('CPF')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('kinship')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Parentesco')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('dependent_ir')
                    ->rules(['required', 'max:255'])
                    ->searchable()
                    ->options([
                        'SIM' => 'SIM',
                        'NAO' => 'NÃO',
                    ])
                    ->placeholder('Dependent Ir')
                    ->default('Dependente IR')
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
                Tables\Columns\TextColumn::make('employe.name')->limit(50),
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('birth')->date(),
                Tables\Columns\TextColumn::make('document_cpf')->limit(50),
                Tables\Columns\TextColumn::make('kinship')->limit(50),
                Tables\Columns\TextColumn::make('dependent_ir')->enum([
                    'SIM' => 'SIM',
                    'NAO' => 'NÃO',
                ]),
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

                MultiSelectFilter::make('employe_id')->relationship(
                    'employe',
                    'name'
                ),
            ]);
    }
}
