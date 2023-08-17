<?php

namespace App\Filament\Resources;

use App\Models\Employe;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\EmployeResource\Pages;

class EmployeResource extends Resource
{
    protected static ?string $model = Employe::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                BelongsToSelect::make('company_id')
                    ->rules(['required', 'exists:companies,id'])
                    ->relationship('company', 'name')
                    ->searchable()
                    ->placeholder('Company')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nome Colaborador')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 9,
                    ]),

                TextInput::make('telephone_emergency')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Telefone de Emergência')
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
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Celular')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DatePicker::make('birth')
                    ->rules(['required', 'date'])
                    ->placeholder('Data Nascimento')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('nationality')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nascionalidade')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('gender')
                    ->rules(['required', 'max:255', 'string'])
                    ->searchable()
                    ->options([
                        'M' => 'Masculino',
                        'F' => 'Feminino',
                        'O' => 'Outro',
                    ])
                    ->placeholder('Gender')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('color')
                    ->rules(['required'])
                    ->placeholder('Cor')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                Select::make('civil_status')
                    ->rules(['required', 'max:255', 'string'])
                    ->searchable()
                    ->options([
                        'SOLTEIRO' => 'Solteiro(a)',
                        'UNIAO_ESTAVEL' => 'União Estável',
                        'DIVORCIADO' => 'Divorciado(a)',
                        'CASADO' => 'Casado(a)',
                        'VIUVO' => 'Viuvo(a)',
                    ])
                    ->placeholder('Civil Status')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('scholarity')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Escolaridade')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('sons')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Nº Filhos')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 2,
                    ]),

                TextInput::make('name_dad')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Nome do Pai')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                TextInput::make('name_mother')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Nome Mae')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                TextInput::make('zip_code')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('CEP')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('andress')
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
                    ->rules(['required', 'max:255', 'string'])
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

                TextInput::make('document_rg')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('RG')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                TextInput::make('organization_exp')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Orgão Expedidor')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                DatePicker::make('date_emission_rg')
                    ->rules(['required', 'date'])
                    ->placeholder('Data Emissão RG')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('document_cpf')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('CPF')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('document_pis')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('PIS')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('document_ctps')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Nº CTPS')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                TextInput::make('document_ctps_serie')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Série CTPS')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                DatePicker::make('date_emission_ctps')
                    ->rules(['required', 'date'])
                    ->placeholder('Data Emissão CTPS')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('document_title')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Titulo Eleitoral')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('document_title_zone')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Zona Titulo')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 2,
                    ]),

                TextInput::make('document_title_session')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Sessão Titulo')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                DatePicker::make('date_emission_title')
                    ->rules(['nullable', 'date'])
                    ->placeholder('Data Emissão Titulo')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                TextInput::make('document_reservist')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Reservista')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('document_cnh')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('CNH')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 9,
                    ]),

                TextInput::make('document_cnh_category')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Categoria CNH')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                TextInput::make('email')
                    ->rules(['nullable', 'email'])
                    ->email()
                    ->placeholder('E-mail')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('job_functions_id')
                    ->rules(['required', 'exists:job_functions,id'])
                    ->relationship('jobFunctions', 'name')
                    ->searchable()
                    ->placeholder('Job Functions')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DatePicker::make('date_admission')
                    ->rules(['required', 'date'])
                    ->placeholder('Data Admissão')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                FileUpload::make('document')
                    ->rules(['file', 'max:1024'])
                    ->placeholder('Document')
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
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('telephone_emergency')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('telephone')->limit(50),
                Tables\Columns\TextColumn::make('cell_phone')->limit(50),
                Tables\Columns\TextColumn::make('birth')->date(),
                Tables\Columns\TextColumn::make('nationality')->limit(50),
                Tables\Columns\TextColumn::make('gender')->enum([
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                    'O' => 'Outro',
                ]),
                Tables\Columns\TextColumn::make('color')->limit(50),
                Tables\Columns\TextColumn::make('civil_status')->enum([
                    'SOLTEIRO' => 'Solteiro(a)',
                    'UNIAO_ESTAVEL' => 'União Estável',
                    'DIVORCIADO' => 'Divorciado(a)',
                    'CASADO' => 'Casado(a)',
                    'VIUVO' => 'Viuvo(a)',
                ]),
                Tables\Columns\TextColumn::make('scholarity')->limit(50),
                Tables\Columns\TextColumn::make('sons')->limit(50),
                Tables\Columns\TextColumn::make('name_dad')->limit(50),
                Tables\Columns\TextColumn::make('name_mother')->limit(50),
                Tables\Columns\TextColumn::make('zip_code')->limit(50),
                Tables\Columns\TextColumn::make('andress')->limit(50),
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
                Tables\Columns\TextColumn::make('document_rg')->limit(50),
                Tables\Columns\TextColumn::make('organization_exp')->limit(50),
                Tables\Columns\TextColumn::make('date_emission_rg')->date(),
                Tables\Columns\TextColumn::make('document_cpf')->limit(50),
                Tables\Columns\TextColumn::make('document_pis')->limit(50),
                Tables\Columns\TextColumn::make('document_ctps')->limit(50),
                Tables\Columns\TextColumn::make('document_ctps_serie')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('date_emission_ctps')->date(),
                Tables\Columns\TextColumn::make('document_title')->limit(50),
                Tables\Columns\TextColumn::make('document_title_zone')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make(
                    'document_title_session'
                )->limit(50),
                Tables\Columns\TextColumn::make('date_emission_title')->date(),
                Tables\Columns\TextColumn::make('document_reservist')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('document_cnh')->limit(50),
                Tables\Columns\TextColumn::make('document_cnh_category')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('email')->limit(50),
                Tables\Columns\TextColumn::make('jobFunctions.name')->limit(50),
                Tables\Columns\TextColumn::make('date_admission')->date(),
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

                MultiSelectFilter::make('job_functions_id')->relationship(
                    'jobFunctions',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EmployeResource\RelationManagers\ExamsRelationManager::class,
            EmployeResource\RelationManagers\DependentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployes::route('/'),
            'create' => Pages\CreateEmploye::route('/create'),
            'edit' => Pages\EditEmploye::route('/{record}/edit'),
        ];
    }
}
