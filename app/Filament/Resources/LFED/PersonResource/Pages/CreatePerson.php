<?php

namespace App\Filament\Resources\LFED\PersonResource\Pages;

use App\Filament\Resources\LFED\PersonResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
