<?php

namespace App\Filament\Hr\Resources\IncidentRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IncidentRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('incident.name')
                    ->searchable()
                    ->label('الواقعة'),
                TextColumn::make('user.name')
                    ->searchable()
                    ->label('الموظف')
                    ,
                TextColumn::make('ministry.name')
                    ->searchable()
                    ->label('الوزارة'),
                TextColumn::make('department.name')
                    ->searchable()
                    ->label('المديرية'),
                TextColumn::make('position.name')
                    ->searchable()
                        ,
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('hire_date')
                    ->date()
                    ->sortable()
                    ->label('تاريخ المباشرة'),
                TextColumn::make('salary')
                    ->numeric()
                    ->sortable()
                    ->label('الراتب'),
                TextColumn::make('doc_no')
                    ->searchable()
                    ->label('رقم القرار'),
                TextColumn::make('doc_date')
                    ->date()
                    ->sortable()
                    ->label('تاريخ القرار'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}