<?php

namespace App\Filament\Hr\Resources\Performances;

use App\Filament\Hr\Resources\Performances\Pages\CreatePerformance;
use App\Filament\Hr\Resources\Performances\Pages\EditPerformance;
use App\Filament\Hr\Resources\Performances\Pages\ListPerformances;
use App\Filament\Hr\Resources\Performances\Schemas\PerformanceForm;
use App\Filament\Hr\Resources\Performances\Tables\PerformancesTable;
use App\Models\Performance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerformanceResource extends Resource
{
    protected static ?string $model = Performance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Star;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PerformanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerformancesTable::configure($table);
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
            'index' => ListPerformances::route('/'),
            'create' => CreatePerformance::route('/create'),
            'edit' => EditPerformance::route('/{record}/edit'),
        ];
    }
}