<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\IncidentRequests\IncidentRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class IncidentRequestRelationManager extends RelationManager
{
    protected static string $relationship = 'incidentRequest';

    protected static ?string $relatedResource = IncidentRequestResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
