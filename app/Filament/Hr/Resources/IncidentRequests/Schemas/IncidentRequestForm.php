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
                    ->label('الواقعة')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('الموظف'),
                Select::make('ministry_id')
                    ->relationship('ministry', 'name')
                    ->required()
                    ->label('الوزارة')
                        ,
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->label('المديرية'),
                Select::make('position_id')
                    ->relationship('position', 'name')
                    ->required()
                    ->label('الوظيفة'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                   ->label('الفئة'),
                DatePicker::make('hire_date')
                    ->required()
                    ->label('تاريخ المباشرة'),
                TextInput::make('salary')
                    ->numeric()
                    ->default(null)
                    ->label('الراتب'),
                TextInput::make('doc_no')
                    ->required()
                    ->label('رقم القرار'),
                DatePicker::make('doc_date')
                    ->required()
                    ->label('تاريخ القرار'),
            ]);
    }
}