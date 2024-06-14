<?php

namespace App\Filament\Resources\LFED\ProjectResource\Pages;

use App\Filament\Resources\LFED\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
