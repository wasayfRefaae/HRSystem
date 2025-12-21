<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\User;
use App\Models\VacationRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GeneralOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
             Stat::make('Number of Employees',User::count())
            ->description('Total Employees')
            ->descriptionIcon('heroicon-o-users')
            ->color('succes'),

            Stat::make('Number of Departments',Department::count())
            ->description('Total Departments')
            ->descriptionIcon('heroicon-o-building-office')
            ->color('Info'),

            Stat::make('Pending Vacation Requests', VacationRequest::where('status', 'pending')->count())
            ->description('Awaiting approval')
            ->descriptionIcon('heroicon-o-calendar-days')
            ->color('warning'),
            //
        ];
    }
}