<?php

namespace App\Filament\Hr\Resources\IncidentRequests\Pages;

use App\Filament\Hr\Resources\IncidentRequests\IncidentRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIncidentRequests extends ListRecords
{
    protected static string $resource = IncidentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
