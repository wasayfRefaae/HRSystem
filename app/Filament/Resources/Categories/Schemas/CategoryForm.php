<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->default(''),
                TextInput::make('categ_ceil')
                    ->required()
                    ->numeric(),
                TextInput::make('categ_ceil_curr')
                    ->required()
                    ->numeric(),
            ]);
    }
}
