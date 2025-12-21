<?php

namespace App\Filament\Resources\IncidentRequests\Pages;

use App\Filament\Resources\IncidentRequests\IncidentRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIncidentRequest extends CreateRecord
{
    protected static string $resource = IncidentRequestResource::class;
}
