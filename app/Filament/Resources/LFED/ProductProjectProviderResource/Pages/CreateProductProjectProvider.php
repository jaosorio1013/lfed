<?php

namespace App\Filament\Resources\LFED\ProductProjectProviderResource\Pages;

use App\Filament\Resources\LFED\ProductProjectProviderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductProjectProvider extends CreateRecord
{
    protected static string $resource = ProductProjectProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
