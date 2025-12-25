<?php

namespace App\Filament\Hr\Resources\VacationRequests\Pages;

use App\Filament\Hr\Resources\VacationRequests\VacationRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVacationRequest extends EditRecord
{
    protected static string $resource = VacationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
