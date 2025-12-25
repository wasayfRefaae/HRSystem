<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('المديرية'),
                Select::make('ministry_id')
                     ->relationship('ministry', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('الوزارة'),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('الوصف'),
                Select::make('manager_id')
                    ->relationship('manager', 'name')
                    ->default(null)
                    ->label('المدير'),
            ]);
    }
}