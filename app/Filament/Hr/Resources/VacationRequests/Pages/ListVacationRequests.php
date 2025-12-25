<?php

namespace App\Filament\Hr\Resources\VacationRequests\Pages;

use App\Filament\Hr\Resources\VacationRequests\VacationRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVacationRequests extends ListRecords
{
    protected static string $resource = VacationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
