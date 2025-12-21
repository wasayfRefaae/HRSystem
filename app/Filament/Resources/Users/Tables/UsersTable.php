<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('mother_name')
                    ->searchable(),
                IconColumn::make('sex')
                    ->boolean(),
                TextColumn::make('pers_no')
                    ->searchable(),
                TextColumn::make('national_no')
                    ->searchable(),
                TextColumn::make('family_status')
                    ->badge(),
                IconColumn::make('wife')
                    ->boolean(),
                IconColumn::make('child1')
                    ->boolean(),
                IconColumn::make('child2')
                    ->boolean(),
                IconColumn::make('child3')
                    ->boolean(),
                TextColumn::make('child_no')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('uni')
                    ->boolean(),
                IconColumn::make('social_box')
                    ->boolean(),
                TextColumn::make('nationality')
                    ->searchable(),
                TextColumn::make('reg_date_num')
                    ->searchable(),
                ImageColumn::make('image_url'),
                TextColumn::make('category.id')
                    ->searchable(),
                TextColumn::make('degree.name')
                    ->searchable(),
                TextColumn::make('department.name')
                    ->searchable(),
                TextColumn::make('position.name')
                    ->searchable(),
                TextColumn::make('work.name')
                    ->searchable(),
                TextColumn::make('division.name')
                    ->searchable(),
                TextColumn::make('vacation_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('employee_id')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('appoint_no')
                    ->searchable(),
                TextColumn::make('app_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('hire_no')
                    ->searchable(),
                TextColumn::make('shamCash_no')
                    ->searchable(),
                TextColumn::make('days_he_fiveYears')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('days_not_fiveYears')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('employment_type')
                    ->badge(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
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