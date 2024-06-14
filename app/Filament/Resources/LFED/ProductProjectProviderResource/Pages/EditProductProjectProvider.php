<?php

namespace App\Filament\Resources\LFED\ProductProjectProviderResource\Pages;

use App\Filament\Resources\LFED\ProductProjectProviderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProductProjectProvider extends EditRecord
{
    protected static string $resource = ProductProjectProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
