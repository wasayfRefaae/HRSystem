<?php

namespace App\Filament\Hr\Resources\IncidentRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IncidentRequestForm
{
   public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('incident_id')
                    ->relationship('incident', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('ministry_id')
                    ->relationship('ministry', 'name')
                    ->required(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required(),
                Select::make('position_id')
                    ->relationship('position', 'name')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                DatePicker::make('hire_date')
                    ->required(),
                TextInput::make('salary')
                    ->numeric()
                    ->default(null),
                TextInput::make('doc_no')
                    ->required(),
                DatePicker::make('doc_date')
                    ->required(),
            ]);
    }
}