<?php

namespace App\Filament\Resources\LFED\ProductCategoryResource\Pages;

use App\Filament\Resources\LFED\ProductCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
