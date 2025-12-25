<?php

namespace App\Filament\Hr\Resources\IncidentRequests\Pages;

use App\Filament\Hr\Resources\IncidentRequests\IncidentRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIncidentRequest extends EditRecord
{
    protected static string $resource = IncidentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
