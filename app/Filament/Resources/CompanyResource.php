<?php

namespace App\Filament\Resources;

use App\Models\Company;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CompanyResource\Pages;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nome Empresa')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('fantasy_name')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Nome Fantasia')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('document_cnpj')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('CNPJ')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('zip_code')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('CEP')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('address')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Endereço')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 9,
                    ]),

                TextInput::make('number')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Número')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                TextInput::make('district')
                    ->rules(['required', 'max:2', 'string'])
                    ->placeholder('Bairro')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('complement')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Complemento')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('city')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Cidade')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 9,
                    ]),

                Select::make('state')
                    ->rules(['required', 'max:2'])
                    ->searchable()
                    ->options([
                        'AC' => 'AC',
                        'AL' => 'AL',
                        'AP' => 'AP',
                        'AM' => 'AM',
                        'BA' => 'BA',
                        'CE' => 'CE',
                        'DF' => 'DF',
                        'ES' => 'ES',
                        'GO' => 'GO',
                        'MA' => 'MA',
                        'MT' => 'MT',
                        'MS' => 'MS',
                        'MG' => 'MG',
                        'PA' => 'PA',
                        'PB' => 'PB',
                        'PR' => 'PR',
                        'PE' => 'PE',
                        'PI' => 'PI',
                        'RJ' => 'RJ',
                        'RN' => 'RN',
                        'RS' => 'RS',
                        'RO' => 'RO',
                        'RR' => 'RR',
                        'SC' => 'SC',
                        'SP' => 'SP',
                        'SE' => 'SE',
                        'TO' => 'TO',
                    ])
                    ->placeholder('State')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                TextInput::make('telephone')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Telefone')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('cell_phone')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Celular')
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
                Tables\Columns\TextColumn::make('fantasy_name')->limit(50),
                Tables\Columns\TextColumn::make('document_cnpj')->limit(50),
                Tables\Columns\TextColumn::make('zip_code')->limit(50),
                Tables\Columns\TextColumn::make('address')->limit(50),
                Tables\Columns\TextColumn::make('number')->limit(50),
                Tables\Columns\TextColumn::make('district')->limit(50),
                Tables\Columns\TextColumn::make('complement')->limit(50),
                Tables\Columns\TextColumn::make('city')->limit(50),
                Tables\Columns\TextColumn::make('state')->enum([
                    'AC' => 'AC',
                    'AL' => 'AL',
                    'AP' => 'AP',
                    'AM' => 'AM',
                    'BA' => 'BA',
                    'CE' => 'CE',
                    'DF' => 'DF',
                    'ES' => 'ES',
                    'GO' => 'GO',
                    'MA' => 'MA',
                    'MT' => 'MT',
                    'MS' => 'MS',
                    'MG' => 'MG',
                    'PA' => 'PA',
                    'PB' => 'PB',
                    'PR' => 'PR',
                    'PE' => 'PE',
                    'PI' => 'PI',
                    'RJ' => 'RJ',
                    'RN' => 'RN',
                    'RS' => 'RS',
                    'RO' => 'RO',
                    'RR' => 'RR',
                    'SC' => 'SC',
                    'SP' => 'SP',
                    'SE' => 'SE',
                    'TO' => 'TO',
                ]),
                Tables\Columns\TextColumn::make('telephone')->limit(50),
                Tables\Columns\TextColumn::make('cell_phone')->limit(50),
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
        return [CompanyResource\RelationManagers\ExamsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
