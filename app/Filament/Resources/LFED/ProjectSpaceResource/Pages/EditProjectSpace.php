<?php

namespace App\Filament\Resources\LFED\ProjectSpaceResource\Pages;

use App\Filament\Resources\LFED\ProjectSpaceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectSpace extends EditRecord
{
    protected static string $resource = ProjectSpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
