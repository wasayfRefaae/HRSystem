<?php

namespace App\Filament\Hr\Resources\Performances\Pages;

use App\Filament\Hr\Resources\Performances\PerformanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerformance extends EditRecord
{
    protected static string $resource = PerformanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
