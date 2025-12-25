<?php

namespace App\Filament\Hr\Resources\IncidentRequests;

use App\Filament\Hr\Resources\IncidentRequests\Pages\CreateIncidentRequest;
use App\Filament\Hr\Resources\IncidentRequests\Pages\EditIncidentRequest;
use App\Filament\Hr\Resources\IncidentRequests\Pages\ListIncidentRequests;
use App\Filament\Hr\Resources\IncidentRequests\Schemas\IncidentRequestForm;
use App\Filament\Hr\Resources\IncidentRequests\Tables\IncidentRequestsTable;
use App\Models\IncidentRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncidentRequestResource extends Resource
{
    protected static ?string $model = IncidentRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return IncidentRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncidentRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIncidentRequests::route('/'),
            'create' => CreateIncidentRequest::route('/create'),
            'edit' => EditIncidentRequest::route('/{record}/edit'),
        ];
    }
}
