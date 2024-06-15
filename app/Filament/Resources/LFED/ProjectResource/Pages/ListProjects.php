<?php

namespace App\Filament\Resources\LFED\ProjectResource\Pages;

use App\Filament\Resources\LFED\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('Todo'),
            'Activos' => ListRecords\Tab::make()->query(fn ($query) => $query->whereNotNull('won_at')->whereNull('finished_at')),
            // 'processing' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'processing')),
            // 'shipped' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'shipped')),
            // 'delivered' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'delivered')),
            // 'cancelled' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}
