<?php

namespace App\Filament\Resources\LFED\QuoteResource\Pages;

use App\Filament\Resources\LFED\QuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
