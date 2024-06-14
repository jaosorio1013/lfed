<?php

namespace App\Filament\Resources\LFED\ProductResource\Pages;

use App\Filament\Resources\LFED\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
