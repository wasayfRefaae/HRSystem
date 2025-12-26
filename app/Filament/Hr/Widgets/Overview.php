<?php

namespace App\Filament\Hr\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

use App\Models\VacationRequest;
class Overview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
         return [
            Stat::make('Active Employees', User::where('status', 'active')->count())
            ->description('Currently active')
            ->descriptionIcon('heroicon-o-users')
            ->color('success'),
            Stat::make('Pending Vacations', VacationRequest::where('status', 'pending')->count())
                ->description('Requires action')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('warning'),
            
        ];
    }
}