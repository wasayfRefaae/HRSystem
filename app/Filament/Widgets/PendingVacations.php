<?php

namespace App\Filament\Widgets;

use App\Models\VacationRequest as ModelsVacationRequest;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use VacationRequest;

class PendingVacations extends TableWidget
{
     protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => ModelsVacationRequest::query()->where('status', 'pending'))
            ->columns([
                 TextColumn::make('user.name')
                     ->searchable()
                    ->sortable(),
                TextColumn::make('vacation.name')
                    ->searchable(),
                TextColumn::make('request_date')
                    ->searchable(),
                TextColumn::make('year'),
              
              
                TextColumn::make('days_per_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('used_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('remain_days')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}