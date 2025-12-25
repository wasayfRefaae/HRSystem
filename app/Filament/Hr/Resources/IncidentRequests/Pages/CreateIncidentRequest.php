<?php

namespace App\Filament\Hr\Resources\IncidentRequests\Pages;

use App\Filament\Hr\Resources\IncidentRequests\IncidentRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIncidentRequest extends CreateRecord
{
    protected static string $resource = IncidentRequestResource::class;
}
