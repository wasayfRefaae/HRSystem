<?php

namespace App\Filament\Resources\IncidentRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
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
                      ->label('اسم الموظف'),
                    
                TextColumn::make('ministry.name')
                      ->searchable()
                      ->label('الوزارة'),
                TextColumn::make('department.name')
                    ->searchable()
                    ->label('المديرية'),
                TextColumn::make('position.name')
                    ->label('المركز الوظيفي')
                      ->searchable(),
                TextColumn::make('category.name')
                    ->label('الفئة')
                    ->searchable(),
                TextColumn::make('hire_date')
                    ->date()
                ->label('تاريخ المباشرة')
                    ->sortable(),
                TextColumn::make('salary')
                    ->numeric()
                    ->label('الراتب')
                    ->sortable(),
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
                DeleteAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}