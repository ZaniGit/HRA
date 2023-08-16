<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class ExamsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'exams';

    protected static ?string $recordTitleAttribute = 'units';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                BelongsToSelect::make('employe_id')
                    ->rules(['required', 'exists:employes,id'])
                    ->relationship('employe', 'name')
                    ->searchable()
                    ->placeholder('Employe')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('units')
                    ->rules(['required', 'max:255', 'string'])
                    ->searchable()
                    ->options([
                        'UC' => 'Unidade Centro',
                        'US' => 'Unidade Sede',
                        'UF' => 'Unidade Filial',
                    ])
                    ->placeholder('Units')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('type_exam')
                    ->rules(['required', 'max:255', 'string'])
                    ->searchable()
                    ->options([
                        'ADMISSIONAL' => 'ADMISSIONAL',
                        'DEMISSIONAL' => 'DEMISSIONAL',
                        'PERIODICO' => 'PERIODICO',
                        'MUDANCA_FUNCAO' => 'MUDANÇA DE FUNCAO',
                        'RETORNO_TRABALHO' => 'RETORNO AO TRABALHO',
                        'AVALIACAO_MEDICA_AT' => 'AVALIACAO MEDICA /AT',
                        'AVALIACAO_PCD' => 'AVALIACAO PCD',
                        'EXAME_COMPLEMENTARES' => 'EXAMES COMPLEMENTARES',
                    ])
                    ->placeholder('Type Exam')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('done')
                    ->rules(['required', 'max:1'])
                    ->searchable()
                    ->options([
                        'N' => 'Não',
                        'S' => 'Sim',
                    ])
                    ->placeholder('Done')
                    ->default('N')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')->limit(50),
                Tables\Columns\TextColumn::make('employe.name')->limit(50),
                Tables\Columns\TextColumn::make('units')->enum([
                    'UC' => 'Unidade Centro',
                    'US' => 'Unidade Sede',
                    'UF' => 'Unidade Filial',
                ]),
                Tables\Columns\TextColumn::make('type_exam')->enum([
                    'ADMISSIONAL' => 'ADMISSIONAL',
                    'DEMISSIONAL' => 'DEMISSIONAL',
                    'PERIODICO' => 'PERIODICO',
                    'MUDANCA_FUNCAO' => 'MUDANÇA DE FUNCAO',
                    'RETORNO_TRABALHO' => 'RETORNO AO TRABALHO',
                    'AVALIACAO_MEDICA_AT' => 'AVALIACAO MEDICA /AT',
                    'AVALIACAO_PCD' => 'AVALIACAO PCD',
                    'EXAME_COMPLEMENTARES' => 'EXAMES COMPLEMENTARES',
                ]),
                Tables\Columns\TextColumn::make('done')->enum([
                    'N' => 'Não',
                    'S' => 'Sim',
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

                MultiSelectFilter::make('company_id')->relationship(
                    'company',
                    'name'
                ),

                MultiSelectFilter::make('employe_id')->relationship(
                    'employe',
                    'name'
                ),
            ]);
    }
}
