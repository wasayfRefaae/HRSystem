<?php

namespace App\Filament\Resources\VacationRequests\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Resources\Form;
use Illuminate\Support\Facades\Auth;
use App\Model\App\Models\User;
use App\Models\User as ModelsUser;
use App\Models\VacationRequest;
use Illuminate\Foundation\Auth\User as AuthUser;

class VacationRequestForm
{
     protected ?string $lastVacationData = null;
    // var null|string $lastVacationData;
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                  Select::make('user_id')
                 ->label('Colleagues in Your Department')
                ->options(function () {
                    $user = Auth::user();
                    return $user->departmentColleagues->pluck('name', 'id');
                    
                })
                ->searchable()
                ->required()
                ->preload()
                
             /*    ->afterStateUpdated(function ($state,Set $set, Get $get) {
                        if ($state) {
                            // Get last vacation request for the selected user
                            $lastRequest = VacationRequest::where('user_id', $state)
                                ->latest()
                                ->first();
                            
                            if ($lastRequest) {
                               ([
                                    'days_per_year' => $lastRequest->days_per_year,
                                    'used_days' => $lastRequest->used_days,
                                    'remain_days' => $lastRequest->remain_days,
                                    
                                ]);
                            } else {
                                $set('last_vacation_info', null);
                            }
                        }
                    })*/
                        ->afterStateUpdated(fn($state, Set $set, Get $get)=> 
                        self::getLastRecord($set,$get)),
                   
                 
                Select::make('vacation_id')
                    ->relationship('vacation', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                DatePicker::make('request_date')
                    ->required()
                  ->default(now()->toDateString())
               // ->disabled()
                  ,
                TextInput::make('year')
                    ->required()
                    ->default('2025'),
                DatePicker::make('start_date')
                     ->live()
                    ->required()
                    ->afterStateUpdated(fn($state, Set $set, Get $get)=> 
                        self::calculateDays($set,$get)),
                DatePicker::make('end_date')
                     ->live()
                    ->required()
                    ->afterStateUpdated(fn($state, Set $set, Get $get)=> 
                        self::calculateDays($set,$get)),
                TextInput::make('vac_days')
                    ->numeric()
                    ->default(null)
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('vac_months')
                    ->numeric()
                    ->visible(fn(Get $get) => $get('vacation_id') ===2)
                    ->default(null),
                TextInput::make('days_per_year')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->default(null),
                TextInput::make('used_days')
                    ->numeric()
                    ->dehydrated()
                 
                    ->default(null),
                TextInput::make('remain_days')
                    ->numeric()
                    ->dehydrated()
                    ->default(null)
                  //  ->disabled()
                    ,
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required()
                    ->live()
                    ->disabled(),
                Textarea::make('reason')
                    ->required()
                     ->visible(fn(Get $get) => $get('status') === 'rejected')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('doc_no')
                    ->default(null),
                DatePicker::make('doc_date'),
                DateTimePicker::make('approved_at')
                ->hidden(),
                   ]);
    }
     protected static function calculateDays(Set $set, Get $get){
        $start = $get('start_date');
        $end = $get('end_date');

        if ($start && $end) {
            $startDate = Carbon::parse($start);
            $endDate = Carbon::parse($end);
            $days = $startDate->diffInDays($endDate) + 1;

            $set('vac_days', $days);
        }
    }

     protected static function getLastRecord(Set $set, Get $get){
         $user_id = $get('user_id');
       
        $lastRequest = VacationRequest::where('user_id', $user_id)->where('vacation_id', 1)

                                ->latest()
                                ->first();
        $days_per_year = $lastRequest->days_per_year;
        $used_days =  $lastRequest->used_days;
        $remain_days =  $lastRequest->remain_days;

            $set('days_per_year', $days_per_year);
             $set('used_days', $used_days);
              $set('remain_days', $remain_days);
        
    }
}