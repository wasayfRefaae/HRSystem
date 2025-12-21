<?php

namespace App\Filament\Resources\IncidentRequests\Schemas;

use App\Models\IncidentRequest;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                    ->required()
                      ->afterStateUpdated(fn($state, Set $set, Get $get)=> 
                        self::displayInfo($set,$get)),
                Select::make('ministry_id')
                ->relationship('ministry', 'name')
                    ->required()
                    ->dehydrated()
                    ,
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->dehydrated(),
                Select::make('position_id')
                ->relationship('position', 'name')
                    ->required()
                    ->dehydrated()
                ,
                Select::make('category_id')
                ->relationship('category', 'name')
                    ->required()
                    ->dehydrated()
                    ,
                DatePicker::make('hire_date')
                    ->required()
                    ->dehydrated(),
                TextInput::make('salary')
                    ->numeric()
                    ->dehydrated()
                  //  ->default(null)
                  ,
                TextInput::make('doc_no')
                    ->required(),
                DatePicker::make('doc_date')
                    ->required(),
            ]);
    }
    protected static function displayInfo(Set $set, Get $get){
         $user_id = $get('user_id');
       
        $employee = IncidentRequest::where('user_id', $user_id)
        ->latest()
        ->first();
        $hire_date = $employee->hire_date;
   

                         /*    $set('ministry_id', $employee->ministry_id);
                            $set('hire_date', $employee->hire_date);
                            $set('department_id', $employee->department_id);
                            $set('position_id', $employee->position_id);
                            $set('category_id', $employee->category_id);*/
     $set('hire_date', $hire_date);
 
    }


                            
}