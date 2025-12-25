<?php

namespace App\Filament\Resources\VacationRequests;

use App\Filament\Resources\VacationRequests\Pages\CreateVacationRequest;
use App\Filament\Resources\VacationRequests\Pages\EditVacationRequest;
use App\Filament\Resources\VacationRequests\Pages\ListVacationRequests;
use App\Filament\Resources\VacationRequests\Schemas\VacationRequestForm;
use App\Filament\Resources\VacationRequests\Tables\VacationRequestsTable;
use App\Models\VacationRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VacationRequestResource extends Resource
{
    protected static ?string $model = VacationRequest::class;

     protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar;

    protected static string | UnitEnum | null $navigationGroup = 'Vacations Management';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return VacationRequestForm::configure($schema);
    }

    /* public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // If the user has the 'manager' role, filter the vacation requests to only those in their department
        if ( Department::where('manager_id',Auth::user()->id)->value('manager_id'))  {
            $managerDepartmentId = Auth::user()->department_id;
            $employeeIds = User::where('department_id', $managerDepartmentId)->pluck('id');
            $query->whereIn('user_id', $employeeIds);
        }

        return $query;
    }*/

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