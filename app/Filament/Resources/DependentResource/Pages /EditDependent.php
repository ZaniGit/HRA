<?php

namespace App\Filament\Resources\DependentResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DependentResource;

class EditDependent extends EditRecord
{
    protected static string $resource = DependentResource::class;
}
