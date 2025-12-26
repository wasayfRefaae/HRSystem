<?php

namespace App\Filament\Hr\Resources\VacationRequests;

use App\Filament\Hr\Resources\VacationRequests\Pages\CreateVacationRequest;
use App\Filament\Hr\Resources\VacationRequests\Pages\EditVacationRequest;
use App\Filament\Hr\Resources\VacationRequests\Pages\ListVacationRequests;
use App\Filament\Hr\Resources\VacationRequests\Schemas\VacationRequestForm;
use App\Filament\Hr\Resources\VacationRequests\Tables\VacationRequestsTable;
use App\Models\VacationRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VacationRequestResource extends Resource
{
    protected static ?string $model = VacationRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return VacationRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VacationRequestsTable::configure($table);
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
            'index' => ListVacationRequests::route('/'),
            'create' => CreateVacationRequest::route('/create'),
            'edit' => EditVacationRequest::route('/{record}/edit'),
        ];
    }
}