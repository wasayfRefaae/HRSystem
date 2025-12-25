<?php

namespace App\Filament\Resources\Vacations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VacationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('نوع الإجازة')
                    ->required(),
            ]);
    }
}