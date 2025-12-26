<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Personal Informations")
                ->columns(2)
                ->schema([
                     TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create'),
                TextInput::make('first_name')->required()
                    ->default(null),
                TextInput::make('middle_name')->required()
                    ->default(null),
                TextInput::make('last_name')->required()
                    ->default(null),
                TextInput::make('mother_name')->required()
                    ->default(null),
                ToggleButtons::make('sex')
                    ->options([
            'ذكر' => 'ذكر',
            'أنثى' => 'أنثى',
            
        ])
         ->colors([
                        'ذكر'=> 'success',
                        
                        'أنثى'=> 'danger',
                      
                    ])
                    ->grouped()
                    ->default('full-time')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('pers_no')->required()
                    ->default(null),
                TextInput::make('national_no')->required()->required()
                    ->default(null),
                      TextInput::make('phone')
                    ->tel()
                    ->default(null),
                DatePicker::make('birth_date'),
                Select::make('family_status')
                    ->options([
            'أعزب' => 'أعزب',
            'متزوج' => 'متزوج',
            'أرمل' => 'أرمل',
            'مطلق' => 'مطلق',
        ])
                    ->default('أعزب'),
                Toggle::make('wife'),
                Toggle::make('child1'),
                Toggle::make('child2'),
                Toggle::make('child3'),
                TextInput::make('child_no')
                    ->numeric()
                    ->default(null),
                      FileUpload::make('image_url')
                    ->image()->columnSpanFull(),
                    Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                    Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                ]),
                

                 Section::make("Employment Informations")
                ->columns(2)
                ->schema([
                    TextInput::make('employee_id')
                    ->label('Employee Code')
                    ->readOnly()
                    ->unique(ignoreRecord: true)
                 //   ->hiddenOn('create')
                    ->columnSpanFull(),
                    
                    Toggle::make('uni'),
                Toggle::make('social_box'),
                TextInput::make('nationality')
                    ->default(null),
                TextInput::make('reg_date_num')
                    ->default(null),
              
                Select::make('category_id')
                ->required()
                    ->relationship('category', 'name')
                    ->default(null),
                Select::make('degree_id')
                ->required()
                    ->relationship('degree', 'name')
                    ->default(null),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live(),
                    Select::make('division_id')
                    ->relationship('division', 'name', fn($query, Get $get)=> 
                        $query->where('department_id', $get('department_id')))
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('position_id')
                ->required()
                    ->relationship('position', 'name')
                    ->default(null),
                Select::make('work_id')
                ->required()
                    ->relationship('work', 'name')
                    ->default(null),
                
                
                DatePicker::make('hire_date'),
                TextInput::make('appoint_no')
                    ->default(null),
                DatePicker::make('app_date'),
                TextInput::make('hire_no')
                    ->default(null),
                TextInput::make('shamCash_no')
                    ->default(null),
             
                ToggleButtons::make('employment_type')
                    ->options([
            'full-time' => 'Full time',
            'part-time' => 'Part time',
            'contract' => 'Contract',
            'intern' => 'Intern',
        ])
                   ->colors([
                        'full-time'=> 'success',
                        'part-time'=> 'warning',
                        'contract'=> 'danger',
                        'intern'=> 'info',
                    ])
                    ->grouped()
                    ->default('full-time')
                    ->columnSpanFull()
                    ->required(),
                Select::make('status')
                    ->options([
            'على رأس عمله' => 'على رأس عمله',
            'إنهاء خدمة' => 'إنهاء خدمة',
            'استقالة' => 'استقالة',
            'بحكم المستقيل' => 'بحكم المستقيل',
        ])
                    ->default('على رأس عمله')
                    ->required(),
                TextInput::make('salary')
                    ->numeric()
                    ->default(null),
                
                ])
               
                
            ]);
    }
}