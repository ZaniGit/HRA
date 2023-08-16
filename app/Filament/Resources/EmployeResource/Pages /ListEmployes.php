<?php

namespace App\Filament\Resources\EmployeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\EmployeResource;

class ListEmployes extends ListRecords
{
    protected static string $resource = EmployeResource::class;
}
