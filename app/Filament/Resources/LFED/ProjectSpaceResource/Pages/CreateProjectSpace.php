<?php

namespace App\Filament\Resources\LFED\ProjectSpaceResource\Pages;

use App\Filament\Resources\LFED\ProjectSpaceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectSpace extends CreateRecord
{
    protected static string $resource = ProjectSpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
