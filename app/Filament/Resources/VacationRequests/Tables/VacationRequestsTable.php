<?php

namespace App\Filament\Resources\VacationRequests\Tables;

use App\Jobs\CalculateVacationDays;
use App\Models\VacationRequest;
use Filament\Actions\Action as ActionsAction;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class VacationRequestsTable
{
   public static function configure(Table $table): Table
    {
        return $table


 ->headerActions([
           Action::make("generate_vacation_days")
            ->label("Generate Vacation Days for this year")
            ->icon("heroicon-o-cog")
            ->color("success")
            ->schema([
                
                TextInput::make('year')
                        ->required()
                        ->numeric()
                        ->default(now()->year)
                        ->minValue(2020)
                        ->maxValue(now()->year + 1),
                Select::make('user_id')
                        ->label('Employee (Optional)')
                        ->placeholder('Generate for all employees')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload(),
            ])
            ->action(function(array $data){
                CalculateVacationDays::dispatch( $data['year'], $data['user_id'] ?? null);

                Notification::make()
                ->success()
                ->title('Calculation Started')
                ->body('Calculate for Employees Vacation is being started in the background. You will receive will be notified once completed.')
                ->send();
                        })
        ])



        
            ->columns([
                TextColumn::make('user.name')
                     ->searchable()
                    ->sortable(),
                TextColumn::make('vacation.name')
                    ->searchable(),
                TextColumn::make('request_date')
                    ->searchable(),
                TextColumn::make('year'),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('vac_days')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vac_months')
                    ->numeric()
                    ->sortable(),
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
                TextColumn::make('doc_no')
                    ->searchable(),
                TextColumn::make('doc_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('approved_by')
                  
                    ->sortable(),
                TextColumn::make('approved_at')
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
            ])
           
            ->recordActions([
                EditAction::make(),
                Action::make('approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn(VacationRequest $record) => $record->status === 'pending')
                ->action(function(VacationRequest $record){
                    $record->update([
                        'status'=> 'approved',
                        'approved_by' => Auth::user()->id,
                        'approved_at'=> now(),
                        'used_days' =>(int) ($record->used_days + $record->vac_days) ,
                        'remain_days' => (int) ($record->remain_days - (float)$record->vac_days),

                    ]);

                    Notification::make()
                    ->success()
                    ->title('Leave approved')
                    ->send();
                }),
                Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn(VacationRequest $record) => $record->status === 'pending')
                ->schema([
                    Textarea::make('rejection_reason')
                    ->required()
                    ->rows(3)
                ])
                ->action(function(VacationRequest $record, array $data){
                    $record->update([
                        'status'=> 'rejected',
                        'approved_by' => Auth::user()?->id,
                        'approved_at'=> now(),
                        'rejection_reason' => $data['rejection_reason']
                    ]);

                    Notification::make()
                    ->success()
                    ->title('Leave Rejected')
                    ->send();
                })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}