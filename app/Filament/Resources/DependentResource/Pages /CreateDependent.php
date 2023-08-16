<?php

namespace App\Filament\Resources\DependentResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DependentResource;

class CreateDependent extends CreateRecord
{
    protected static string $resource = DependentResource::class;
}
