<?php

namespace App\Filament\Resources\LFED\PersonResource\Pages;

use App\Filament\Resources\LFED\PersonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('Todos'),
            'Cliente' => ListRecords\Tab::make()->query(fn ($query) => $query->where('is_client', true)),
            'Proveedor' => ListRecords\Tab::make()->query(fn ($query) => $query->where('is_provider', true)),
        ];
    }
}
