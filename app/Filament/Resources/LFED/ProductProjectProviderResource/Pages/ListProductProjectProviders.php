<?php

namespace App\Filament\Resources\LFED\ProductProjectProviderResource\Pages;

use App\Filament\Resources\LFED\ProductProjectProviderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductProjectProviders extends ListRecords
{
    protected static string $resource = ProductProjectProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
