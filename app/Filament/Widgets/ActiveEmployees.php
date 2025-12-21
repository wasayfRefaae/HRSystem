<?php

namespace App\Filament\Widgets;

use App\Models\User as ModelsUser;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use User;
use Filament\Actions\ViewAction;
     use Filament\Actions\DeleteAction;
     
  use Filament\Actions\EditAction;

class ActiveEmployees extends TableWidget
{ protected static ?int $sort = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => ModelsUser::query()->where('status','على رأس عمله'))
            ->columns([
                 TextColumn::make('name')
                    ->searchable(),
            
                TextColumn::make('last_name')
                    ->searchable(),
            
                TextColumn::make('department.name')
                    ->searchable(),
               
                
                TextColumn::make('status')
                    ->badge(),
                
                //
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
             DeleteAction::make(),
                ViewAction::make(),
                
                EditAction::make(),
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}