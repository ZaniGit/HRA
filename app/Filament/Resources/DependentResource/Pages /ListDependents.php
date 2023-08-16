<?php

namespace App\Filament\Resources\DependentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DependentResource;

class ListDependents extends ListRecords
{
    protected static string $resource = DependentResource::class;
}
