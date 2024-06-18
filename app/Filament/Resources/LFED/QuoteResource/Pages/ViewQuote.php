<?php

namespace App\Filament\Resources\LFED\QuoteResource\Pages;

use App\Filament\Resources\LFED\QuoteResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use URL;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Edit Quote')
                ->icon('heroicon-m-pencil-square')
                ->url(EditQuote::getUrl([$this->record])),

            Action::make('Download Quote')
                ->icon('heroicon-s-document-check')
                // ->url(URL::signedRoute('quotes.pdf', [$this->record->id]), true),
                ->url(URL::signedRoute('export-quote', ['quote_id' => $this->record->id]), true),
        ];
    }

}