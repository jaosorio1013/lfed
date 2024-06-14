<?php

namespace App\Filament\Resources\LFED\ProjectSpaceResource\Pages;

use App\Filament\Resources\LFED\ProjectSpaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectSpaces extends ListRecords
{
    protected static string $resource = ProjectSpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
