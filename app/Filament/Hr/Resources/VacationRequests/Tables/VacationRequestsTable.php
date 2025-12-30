<?php

namespace App\Filament\Hr\Resources\VacationRequests\Tables;



use App\Jobs\CalculateVacationDays;
use App\Models\Department;
use App\Models\User;
use App\Models\VacationRequest;
use App\Notifications\VacationRequestStatusNotification;
//use Filament\Actions\Action as ActionsAction;

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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VacationRequestsTable
{
   public static function configure(Table $table): Table
    {
        return $table 
->modifyQueryUsing(function (Builder $query) {

            if (Department::where('manager_id', Auth::user()->id)->value('manager_id')) {
                $managerDepartmentId = Auth::user()->department_id;
                $employeeIds = User::where('department_id', $managerDepartmentId)->pluck('id');
                $query->whereIn('user_id', $employeeIds)
             ;
                
         
            }
         else
                    $query->where('user_id', Auth::user()->id);


            return $query;
        })


        
       
 ->headerActions([
           Action::make("generate_vacation_days")
           //->visible(fn () => Department::where('manager_id', Auth::user()->id)->value('manager_id'))
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
                ->label('الموظف')
                     ->searchable()
                    ->sortable(),
                TextColumn::make('vacation.name')
                ->label('نوع الإجازة')
                    ->searchable(),
                TextColumn::make('request_date')
                ->label('تاريخ الطلب')
                    ->searchable(),
                TextColumn::make('year')
                ->label('السنة'),
                TextColumn::make('start_date')
                ->label('تاريخ البداية')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                ->label('تاريخ النهاية')
                    ->date()
                    ->sortable(),
                TextColumn::make('vac_days')
                ->label(' عدد ايام الإجازة')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vac_months')
                ->label('عدد شهور الإجازة')
                
                    ->numeric()
                    ->sortable(),
                TextColumn::make('days_per_year')
                    
                    ->numeric()
                    ->sortable(),
                TextColumn::make('used_days')
                ->label('عدد الأيام المستخدمة')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('remain_days')
                ->label('عدد الأيام المتبقية')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                ->label('حالة الطلب')
                    ->badge(),
                TextColumn::make('doc_no')
                ->label('رقم القرار')
                    ->searchable(),
                TextColumn::make('doc_date')
                ->label('تاريخ القرار')
                    ->date()
                    ->sortable(),
                TextColumn::make('approved_by')
                
                  ->label('تمت الموافقة من قبل')
                
                  
                    ->sortable(),
                TextColumn::make('approved_at')
                ->label('تاريخ الموافقة')
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
                ->visible(fn () => Department::where('manager_id', Auth::user()->id)->value('manager_id'))
                ->action(function(VacationRequest $record){
                    $record->update([
                        'status'=> 'approved',
                        'approved_by' => Auth::user()?->id,
                        'approved_at'=> now(),
                        'used_days' =>(int) ($record->used_days + $record->vac_days) ,
                        'remain_days' => (int) ($record->remain_days - (float)$record->vac_days),

                    ]);
                    
                 $record->user->notify(new \App\Notifications\VacationApprovedNotification($record));
                  Notification::make()
                    ->success()
                    ->title('vacation approved  and message has been sent to the user email ')
                    ->send();
                    
               
                    
                })
                  ->visible(fn(VacationRequest $record) => $record->status === 'pending')
                  ,
                Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn(VacationRequest $record) => $record->status === 'pending')
                 ->visible(fn () => Department::where('manager_id', Auth::user()->id)->value('manager_id'))
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

                    $record->user->notify(new \App\Notifications\VacationRejectedNotification($record));
                       
                    Notification::make()
                    ->success()
                    ->title('vacation rejected  and message has been sent to the user email')
                    ->send();
                })
                ->visible(fn(VacationRequest $record) => $record->status === 'pending')
            ])
           
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            
    }
}